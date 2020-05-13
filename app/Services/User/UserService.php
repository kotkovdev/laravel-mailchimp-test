<?php
declare(strict_types=1);

namespace App\Services\User;

use App\Database\Entities\Users\User;
use Doctrine\ORM\EntityManager;

/**
 * Class UserService
 * @package App\Services\User
 */
class UserService
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * UserService constructor.
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $data
     * @return \App\Database\Entities\Users\User
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(array $data): User
    {
        $user = new User();
        $user->setEmail($data['email']);
        $user->setFirstName($data['first_name']);
        $user->setLastName($data['last_name']);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;
    }
}