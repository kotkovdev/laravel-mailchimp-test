<?php
declare(strict_types=1);

namespace App\Services\User;

use App\Database\Entities\Users\UserGroup;
use Doctrine\ORM\EntityManager;

/**
 * Class UserGroupService.
 *
 * @package App\Services\User
 */
class UserGroupService
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    private $groupRepository;

    /**
     * UserGroupService constructor.
     *
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->groupRepository = $this->entityManager->getRepository(UserGroup::class);
    }

    /**
     * Create a new user group.
     *
     * @param $data
     *
     * @return \App\Database\Entities\Users\UserGroup
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create($data): UserGroup
    {
        $group = new UserGroup($data);
        $this->entityManager->persist($group);
        $this->entityManager->flush();
        if(is_null($group->getId())) {
            throw new \Exception('Can not create group');
        }
        return $group;
    }

    /**
     * Update the user group.
     *
     * @param string $groupId
     * @param array $data
     *
     * @return \App\Database\Entities\Users\UserGroup
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(string $groupId, array $data): UserGroup
    {
        $group = $this->get($groupId);
        $group->fill($data);
        $this->entityManager->persist($group);
        $this->entityManager->flush();
        return $group;
    }

    /**
     * Delete the user group.
     *
     * @param string $groupId
     *
     * @return bool
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(string $groupId): bool
    {
        $group = $this->get($groupId);
        $this->entityManager->remove($group);
        $this->entityManager->flush();
        return true;
    }

    /**
     * Get the user group.
     *
     * @param $groupId
     *
     * @return object|null
     * @throws \Exception
     */
    public function get($groupId)
    {
        $group = $this->groupRepository->find($groupId);
        if (!isset($group)) {
            throw new \Exception('User group not found');
        }
        return $group;
    }

    /**
     * Get all user groups.
     *
     * @return array
     */
    public function all(): array
    {
        $groups = $this->groupRepository->findALl();
        $groupsList = [];
        foreach ($groups as $group) {
            $groupsList[] = $group->toArray();
        }
        return $groupsList;
    }
}