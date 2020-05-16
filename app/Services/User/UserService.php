<?php
declare(strict_types=1);

namespace App\Services\User;

use App\Database\Entities\Users\User;
use App\Database\Entities\Users\UserGroup;
use Doctrine\ORM\EntityManager;

/**
 * Class UserService.
 *
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

    private $userGroupService;

    /**
     * UserService constructor.
     *
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager, UserGroupService $userGroupService)
    {
        $this->entityManager = $entityManager;
        $this->userGroupService = $userGroupService;
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }

    /**
     * Create a new user.
     *
     * @param array $data
     *
     * @return \App\Database\Entities\Users\User
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(array $data): User
    {
        $user = new User($data);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        if (!$user->getId()) {
            throw new \Exception('Can not create user');
        }
        return $user;
    }

    /**
     * Get user by id.
     *
     * @param string $userId
     *
     * @return \App\Database\Entities\Users\User
     *
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
     * Update the user.
     *
     * @param string $userId
     * @param array $data
     *
     * @return \App\Database\Entities\Users\User
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(string $userId, array $data): User
    {
        $user = $this->get($userId);
        $user->fill($data);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;
    }

    /**
     * Delete the user.
     *
     * @param string $userId
     *
     * @return bool|null
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(string $userId): ?bool
    {
        $user = $this->get($userId);
        $this->entityManager->remove($user);
        $this->entityManager->flush();
        return true;
    }

    /**
     * Get all users.
     *
     * @return array
     *
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