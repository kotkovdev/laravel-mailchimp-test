<?php
declare(strict_types=1);

namespace App\Database\Entities\MailChimp;

use Doctrine\ORM\Mapping as ORM;
use EoneoPay\Utils\Str;
/**
 * @ORM\Entity()
 */
class MailChimpMember extends MailChimpEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     *
     * @var string
     */
    private $memberId;

    /**
     * @ORM\Column(name="mailchimp_id", type="string", nullable=true)
     */
    private $mailchimpId;

    /**
     * @ORM\Column(name="email_address", type="string")
     */
    private $emailAddress;

    /**
     * @ORM\Column(name="email_type", type="string")
     */
    private $emailType;

    /**
     * @ORM\Column(name="status", type="string")
     */
    private $status;

    /**
     * @ORM\Column(name="merge_fields", type="array")
     */
    private $mergeFields;

    /**
     * @ORM\Column(name="interests", type="array")
     */
    private $interests;

    /**
     * @ORM\Column(name="language", type="string")
     */
    private $language;

    /**
     * @ORM\Column(name="vip", type="string")
     */
    private $vip;

    /**
     * @ORM\Column(name="location", type="array")
     */
    private $location;

    /**
     * @ORM\Column(name="marketing_permissions", type="array")
     */
    private $marketingPermissions;

    /**
     * @ORM\Column(name="ip_signup", type="string", nullable=true)
     */
    private $ipSignUp;

    /**
     * @ORM\Column(name="timestamp_signup", type="string", nullable=true)
     */
    private $timestampSignUp;

    /**
     * @ORM\Column(name="ip_opt", type="string", nullable=true)
     */
    private $ipOpt;

    /**
     * @ORM\Column(name="timestamp_opt", type="string", nullable=true)
     */
    private $timestampOpt;

    /**
     * @ORM\Column(name="tags", type="array", nullable=true)
     */
    private $tags;

    /**
     * @ORM\Column(name="unique_email_id", type="string", nullable=true)
     */
    private $uniqueEmailId;

    /**
     * @ORM\Column(name="web_id", type="string", nullable=true)
     */
    private $webId;

    /**
     * @ORM\Column(name="unsubscribe_reason", type="string", nullable=true)
     */
    private $unsubscribeReason;

    /**
     * @ORM\Column(name="stats", type="array", nullable=true)
     */
    private $stats;

    /**
     * @ORM\Column(name="member_rating", type="string", nullable=true)
     */
    private $memberRating;

    /**
     * @ORM\Column(name="last_changed", type="string", nullable=true)
     */
    private $lastChanged;

    /**
     * @ORM\Column(name="last_note", type="array", nullable=true)
     */
    private $lastNote;

    /**
     * @ORM\Column(name="source", type="string", nullable=true)
     */
    private $source;

    /**
     * @ORM\Column(name="tags_count", type="string", nullable=true)
     */
    private $tagsCount;

    /**
     * @ORM\Column(name="list_id", type="string", nullable=true)
     */
    private $listId;

    /**
     * @ORM\Column(name="links", type="array", nullable=true)
     */
    private $links;


    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->memberId;
    }

    /**
     * @param string $mailchimpId
     * @return MailChimpMember
     */
    public function setMailChimpId(string $mailchimpId): MailChimpMember
    {
        $this->mailchimpId = $mailchimpId;
        return $this;
    }

    /**
     * @return string
     */
    public function getMailChimpId(): string
    {
        return $this->mailchimpId;
    }

    /**
     * @param string $email
     * @return MailChimpMember
     */
    public function setEmailAddress(string $email): MailChimpMember
    {
        $this->emailAddress = $email;
        return $this;
    }

    /**
     * @param string $emailType
     * @return MailChimpMember
     */
    public function setEmailType(string $emailType): MailChimpMember
    {
        $this->emailType = $emailType;
        return $this;
    }

    /**
     * @param string $status
     * @return MailChimpMember
     */
    public function setStatus(string $status): MailChimpMember
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param array $mergeFields
     * @return MailChimpMember
     */
    public function setMergeFields(array $mergeFields): MailChimpMember
    {
        $this->mergeFields = $mergeFields;
        return $this;
    }

    /**
     * @param array $interests
     * @return MailChimpMember
     */
    public function setInterests(array $interests): MailChimpMember
    {
        $this->interests = $interests;
        return $this;
    }

    /**
     * @param string $langugage
     * @return MailChimpMember
     */
    public function setLangugage(string $langugage): MailChimpMember
    {
        $this->language = $langugage;
        return $this;
    }

    /**
     * @param bool $vip
     * @return MailChimpMember
     */
    public function setVip(bool $vip): MailChimpMember
    {
        $this->vip = $vip;
        return $this;
    }

    /**
     * @param array $location
     * @return MailChimpMember
     */
    public function setLocation(array $location): MailChimpMember
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @param array $marketingPermissions
     * @return MailChimpMember
     */
    public function setMarketingPermissions(array $marketingPermissions): MailChimpMember
    {
        $this->marketingPermissions = $marketingPermissions;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return MailChimpMember
     */
    public function setLanguage(string $language): MailChimpMember
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getIpSignUp(): string
    {
        return $this->ipSignUp;
    }

    /**
     * @param string $ipSignUp
     * @return MailChimpMember
     */
    public function setIpSignUp(string $ipSignUp): MailChimpMember
    {
        $this->ipSignUp = $ipSignUp;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimestampSignUp(): string
    {
        return $this->timestampSignUp;
    }

    /**
     * @param string $timestampSignUp
     * @return MailChimpMember
     */
    public function setTimestampSignUp(string $timestampSignUp): MailChimpMember
    {
        $this->timestampSignUp = $timestampSignUp;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIpOpt(): string
    {
        return $this->ipOpt;
    }

    /**
     * @param string $ipOpt
     * @return MailChimpMember
     */
    public function setIpOpt(string $ipOpt): MailChimpMember
    {
        $this->ipOpt = $ipOpt;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimestampOpt(): string
    {
        return $this->timestampOpt;
    }

    /**
     * @param string $timestampOpt
     * @return MailChimpMember
     */
    public function setTimestampOpt(string $timestampOpt): MailChimpMember
    {
        $this->timestampOpt = $timestampOpt;
        return $this;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     * @return MailChimpMember
     */
    public function setTags(array $tags): MailChimpMember
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUniqueEmailId()
    {
        return $this->uniqueEmailId;
    }

    /**
     * @param $uniqueEmailId
     * @return MailChimpMember
     */
    public function setUniqueEmailId($uniqueEmailId): MailChimpMember
    {
        $this->uniqueEmailId = $uniqueEmailId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWebId()
    {
        return $this->webId;
    }

    /**
     * @param $webId
     * @return MailChimpMember
     */
    public function setWebId($webId): MailChimpMember
    {
        $this->webId = $webId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUnsubscribeReason()
    {
        return $this->unsubscribeReason;
    }

    /**
     * @param $unsubscribeReason
     * @return MailChimpMember
     */
    public function setUnsubscribeReason($unsubscribeReason): MailChimpMember
    {
        $this->unsubscribeReason = $unsubscribeReason;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStats()
    {
        return $this->stats;
    }

    /**
     * @param $stats
     * @return MailChimpMember
     */
    public function setStats($stats): MailChimpMember
    {
        $this->stats = $stats;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMemberRating()
    {
        return $this->memberRating;
    }

    /**
     * @param $memberRating
     * @return MailChimpMember
     */
    public function setMemberRating($memberRating): MailChimpMember
    {
        $this->memberRating = $memberRating;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastChanged()
    {
        return $this->lastChanged;
    }

    /**
     * @param $lastChanged
     * @return MailChimpMember
     */
    public function setLastChanged($lastChanged): MailChimpMember
    {
        $this->lastChanged = $lastChanged;
        return $this;
    }

    /**
     * @return array
     */
    public function getLastNote(): array
    {
        return $this->lastNote;
    }

    /**
     * @param $lastNote
     * @return MailChimpMember
     */
    public function setLastNote($lastNote): MailChimpMember
    {
        $this->lastNote = $lastNote;
        return $this;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @param string $source
     * @return MailChimpMember
     */
    public function setSource(string $source): MailChimpMember
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return string
     */
    public function getTagsCount(): string
    {
        return $this->tagsCount;
    }

    /**
     * @param string $tagsCount
     * @return MailChimpMember
     */
    public function setTagsCount(string $tagsCount): MailChimpMember
    {
        $this->tagsCount = $tagsCount;
        return $this;
    }

    /**
     * @return string
     */
    public function getListId(): string
    {
        return $this->listId;
    }

    /**
     * @param string $listId
     * @return MailChimpMember
     */
    public function setListId(string $listId): MailChimpMember
    {
        $this->listId = $listId;
        return $this;
    }

    /**
     * @return array
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @param array $links
     * @return MailChimpMember
     */
    public function setLinks(array $links): MailChimpMember
    {
        $this->links = $links;
        return $this;
    }


    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [];
        $str = new Str();

        foreach (\get_object_vars($this) as $property => $value) {
            $array[$str->snake($property)] = $value;
        }

        return $array;
    }

    /**
     * @return array
     */
    public static function getValidationRules(): array
    {
        return [];
    }
}