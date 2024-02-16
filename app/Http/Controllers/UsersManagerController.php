<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserManagerCreateUpdateRequest;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersManagerController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {
    }

    /**
     * Home page users manager
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        return view('users_manager');
    }

    /**
     * Update user
     *
     * @param UserManagerCreateUpdateRequest $request
     * @return JsonResponse
     */
    public function updateUser(UserManagerCreateUpdateRequest $request): JsonResponse
    {
        $request->validated();
        $result = $this->userService->update($request->all());

        return response()->json($result ? 'successful' : 'error',$result ? 200 : 404);
    }

    /**
     * Delete user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteUser(Request $request): JsonResponse
    {
        $request->validate(['username' => 'required|string']);
        $result = $this->userService->delete($request->get('username'));

        return response()->json($result ? 'successful' : 'error',$result ? 200 : 404);
    }

    /**
     * Create user
     *
     * @param UserManagerCreateUpdateRequest $request
     * @return JsonResponse
     */
    public function createUser(UserManagerCreateUpdateRequest $request): JsonResponse
    {
        $request->validated();
        $result = $this->userService->create($request->all());
        if (!$result) {
            return response()->json('User is exist', 409);
        }

        return response()->json('successful', 200);
    }
}
