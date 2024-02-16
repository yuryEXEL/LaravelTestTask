<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService
{
    public function __construct(
        private readonly ClientInterface $client
    ) {
    }

    /**
     * Create user
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool
    {
        $response = $this->client->createUser($data);
        if ($response) {
            $user = User::firstOrCreate([
                'username' => $data['username'],
            ], [
                'username' => $data['username']
            ]);

            return true;
        }

        return false;
    }

    /**
     * Update user
     *
     * @param array $data
     * @return bool
     */
    public function update(array $data): bool
    {
        $response = $this->client->updateUser($data['username'], $data);
        $result = false;
        if ($response) {
            $user = $this->getUserByUsername($data['username']);
            if ($user) {
                $user->update([$data['username']]);
                $result = true;
            }
        }

        return $result;
    }

    /**
     * Delete user
     *
     * @param string $username
     * @return bool
     */
    public function delete(string $username): bool
    {
        $response = $this->client->deleteUser($username);
        $result = false;
        if ($response) {
            $user = $this->getUserByUsername($username);
            if ($user) {
                $user->delete();
                $result = true;
            }
        }

        return $result;
    }

    /**
     * @param string $username
     * @return bool|User
     */
    public function getUserByUsername(string $username): bool|User
    {
        try {
            $user = User::where('username', $username)->firstOrFail();
        } catch (ModelNotFoundException) {
            return false;
        }

        return $user;
    }
}
