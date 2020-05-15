<?php
declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\UserGroupService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * Class GroupController
 * @package App\Http\Controllers\User
 */
class GroupController extends Controller
{
    /**
     * @var \App\Services\User\UserGroupService
     */
    private $groupService;

    /**
     * GroupController constructor.
     * @param \App\Services\User\UserGroupService $groupService
     */
    public function __construct(UserGroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $data = $request->all();
            $group = $this->groupService->create($data);
            return $this->successfulResponse($group->toArray());
        } catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * @param string $groupId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $groupId): JsonResponse
    {
        try {
            $group = $this->groupService->get($groupId);
            return $this->successfulResponse($group->toArray());
        } catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function list()
    {
        try {
            $groups = $this->groupService->all();
            return $this->successfulResponse($groups);
        } catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param string $groupId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $groupId): JsonResponse
    {
        try {
            $group = $this->groupService->update($groupId, $request->all());
            return $this->successfulResponse($group->toArray());
        } catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * @param string $groupId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(string $groupId): JsonResponse
    {
        try {
            $group = $this->groupService->delete($groupId);
            return $this->successfulResponse(['success' => 'true']);
        } catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()], 500);
        }
    }
}