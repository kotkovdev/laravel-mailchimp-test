<?php
declare(strict_types=1);

namespace App\Database\Entities\Users;

use App\Database\Entities\Entity;
use \Doctrine\ORM\Mapping as ORM;
use EoneoPay\Utils\Str;

/**
 * @ORM\Entity()
 */
class UserGroup extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(name="group_id", type="integer")
     * @ORM\GeneratedValue
     */
    private $groupId;

    /**
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="groups")
     * @ORM\JoinColumn(name="users", referencedColumnName="user_id")
     */
    private $users;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->groupId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users): void
    {
        $this->users = $users;
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
}