<?php
declare(strict_types=1);
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Nette\Utils\Json;

/**
 * Class UserController.
 *
 * @package App\Http\Controllers\User
 */
class UserController extends Controller
{
    /**
     * @var \App\Services\User\UserService
     */
    private $userService;

    /**
     * UserController constructor.
     *
     * @param \App\Services\User\UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Create new user.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $data = $request->all();
            $user = $this->userService->create($data);
            return $this->successfulResponse($user->toArray());
        } catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show user by id.
     *
     * @param string $userId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $userId): JsonResponse
    {
        try {
            $user = $this->userService->get($userId);
            return $this->successfulResponse($user->toArray());
        } catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * List all users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(): JsonResponse
    {
        try {
            $users = $this->userService->all();
            return $this->successfulResponse($users);
        } catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the user.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $userId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $userId): JsonResponse
    {
        try {
            $user = $this->userService->update($userId, $request->all());
            return $this->successfulResponse($user->toArray());
        } catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete the user by id.
     *
     * @param string $userId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(string $userId): JsonResponse
    {
        try {
            $result = $this->userService->delete($userId);
            return $this->successfulResponse(['success' => true]);
        } catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()], 500);
        }
    }
}