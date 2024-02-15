<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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
        return view('userManager');
    }

    /**
     * Update user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateUser(Request $request): JsonResponse
    {
        $request->validate($this->getValidateRule());
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
     * @param Request $request
     * @return JsonResponse
     */
    public function createUser(Request $request): JsonResponse
    {
        $request->validate($this->getValidateRule());
        $result = $this->userService->create($request->all());
        if (!$result) {
            return response()->json('User is exist', 409);
        }

        return response()->json('successful', 200);
    }

    /**
     * Get rule for validate form
     *
     * @return string[]
     */
    public function getValidateRule(): array
    {
        $rule = [
            'username' => 'required|string',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string',
            'phone' => 'required|string',
        ];

        return $rule;
    }
}
