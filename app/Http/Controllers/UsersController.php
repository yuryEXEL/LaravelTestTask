<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UsersController extends Controller
{
    /**
     * Home page user list
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();

        return view('index', compact('users'));
    }

    /**
     * Update user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        try {
            $user = User::findOrFail($request->userId);
        } catch (\Throwable) {
            return response()->json('User not found', 404);
        }

        $user->update($request->all());

        return response()->json('successful',200);
    }

    /**
     * Export users to file
     *
     * @return BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new UsersExport, 'users.csv');
    }

    /**
     * Import users from file
     *
     * @param Request $request
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function import(Request $request)
    {
        try {
            $request->validate(['file' => ['required', 'file', 'mimetypes:text/plain,text/csv']]);
        } catch (\Throwable $e) {
            $message = $e->getMessage();
            return response()->json($message, 400);
        }

        $import = new UsersImport();
        Excel::import($import, $request->file('file'));
        $userStatus = [];
        foreach ($import->data as $userData) {
            list($key, $value) = explode(":", $userData);
            $userStatus[$key] = $value;
        }
        $users = User::orderBy('id', 'desc')->get();

        $html = view('layouts.partials.users_table', compact('users','userStatus'))->render();

        return response($html, 200);
    }
}
