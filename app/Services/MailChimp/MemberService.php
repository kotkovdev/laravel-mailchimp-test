<?php
declare(strict_types=1);

namespace App\Services\MailChimp;

use App\Database\Entities\MailChimp\MailChimpMember;
use Doctrine\ORM\EntityManagerInterface;
use Mailchimp\Mailchimp;

/**
 * Class MemberService
 * @package App\Services\MailChimp
 */
class MemberService
{
    /**
     * @var Mailchimp
     */
    private $mailchimp;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * MemberService constructor.
     * @param Mailchimp $mailchimp
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(Mailchimp $mailchimp, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->mailchimp = $mailchimp;
    }

    /**
     * @param string $listId
     * @param array $data
     * @return array
     * @throws \Doctrine\DBAL\ConnectionException
     */
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
                $data = $response->map(function($row) {
                    if (is_object($row)) {
                        return (array)$row;
                    }
                    if (is_int($row)) {
                        return (string)$row;
                    }
                    return $row;
                })->toArray();
                $member->fill($data);
                $this->entityManager->persist($member);
                $this->entityManager->flush();
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

    /**
     * @param string $listId
     * @param string $subscriptionHash
     * @return MailChimpMember
     */
    public function get(string $listId, string $subscriptionHash): MailChimpMember
    {
        try {
            $member = $this->entityManager->getRepository(MailChimpMember::class)
                ->findOneBy(
                    ['mailchimpId' => $subscriptionHash, 'listId' => $listId]
                );
            if (!isset($member)) {
                throw new \Exception("Member not found");
            }
            return $member;
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * @param string $listId
     * @param string $subscriptionHash
     * @return array
     */
    public function show(string $listId, string $subscriptionHash): array
    {
        return $this->get($listId, $subscriptionHash)->toArray();
    }

    /**
     * @param array $data
     * @param string $listId
     * @param string $subscriptionHash
     * @return array
     * @throws \Doctrine\DBAL\ConnectionException
     */
    public function update(array $data, string $listId, string $subscriptionHash): array
    {
        $this->entityManager->getConnection()->beginTransaction();
        $member = $this->get($listId, $subscriptionHash);
        if (!isset($member)) {
            throw new \Exception('Can not found member');
        }
        $member->fill($data);
        $this->entityManager->persist($member);
        $this->entityManager->flush();

        //Update the mailchimp record
        $response = $this->mailchimp->patch(sprintf('lists/%s/members/%s', $listId, $subscriptionHash), $member->toMailChimpArray());
        if ($response->get('error')) {
            $this->entityManager->getConnection()->rollBack();
            throw new \Exception('Error while updating member');
        }
        $this->entityManager->getConnection()->commit();
        return $member->toArray();
    }
}