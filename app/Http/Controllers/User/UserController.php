<?php
declare(strict_types=1);
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create(Request $request): JsonResponse
    {
        $data = $request->all();
        $user = $this->userService->create($data);
        return $this->successfulResponse($user->toArray());
    }
}