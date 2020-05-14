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
     * @var \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    private $userRepository;

    /**
     * UserService constructor.
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $this->entityManager->getRepository(User::class);
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
        if (!$user->getId()) {
            throw new \Exception('Can not create user');
        }
        return $user;
    }

    /**
     * @param string $userId
     * @return \App\Database\Entities\Users\User
     * @throws \Exception
     */
    public function get(string $userId): User
    {
        $user = $this->userRepository->find($userId);
        if (!isset($user)) {
            throw new \Exception('User not found');
        }
        return $user;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function all(): array
    {
        $users = $this->userRepository->findBy([], ['id' => 'asc']);
        $usersList = [];
        foreach ($users as $user) {
            $usersList[] = $user->toArray();
        }
        if (count($usersList) === 0) {
            throw new \Exception('Users is empty');
        }
        return $usersList;
    }
}