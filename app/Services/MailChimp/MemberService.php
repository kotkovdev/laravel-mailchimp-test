<?php
declare(strict_types=1);

namespace App\Services\MailChimp;

use App\Database\Entities\MailChimp\MailChimpMember;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Mailchimp\Mailchimp;

class MemberService
{
    private $mailchimp;

    private $entityManager;

    public function __construct(Mailchimp $mailchimp, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->mailchimp = $mailchimp;
    }

    public function create(string $listId, array $data): array
    {
        $this->entityManager->getConnection()->beginTransaction();
        try {
            $member = new MailChimpMember($data);

            $this->entityManager->persist($member);
            $this->entityManager->flush();

            $response = $this->mailchimp->post(
                sprintf('lists/%s/members', $listId),
                $member->toMailChimpArray()
            );


            if (!$response->get('error')) {
                $member->setMailChimpId($response->get('id'));
                $member->setUniqueEmailId($response->get('unique_email_id'));
                $member->setWebId($response->get('web_id'));
                $member->setStats($response->get('stats'));
                $member->setIpSignUp($response->get('ip_signup'));
                $member->setTimestampSignUp($response->get('timestamp_signup'));
                /**
                 * etc...
                 */
                $this->entityManager->getConnection()->commit();
                return $member->toArray();
            }

        } catch (\Exception $e) {
            $this->entityManager->getConnection()->rollback();
            return [
                'error' => $e->getMessage(),
                'path' => sprintf('lists/%s/members', $listId),
                'member' => $member->toMailChimpArray()
            ];
        }


    }
}