<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;


class Client implements ClientInterface
{
    /**
     * Get user by user name
     *
     * @param string $userName
     * @return bool
     */
    public function getUser(string $userName): bool
    {
        $response = Http::get(self::HOST . '/user/{$userName}');

        return $response->successful();
    }

    /**
     * @param array $data
     * @return bool|
     */
    public function createUser(array $data): bool
    {
        $response = Http::post(self::HOST . '{$this->baseUrl}/user', $data);

        return $response->successful();
    }

    /**
     * Update user on a third-party service
     *
     * @param string $userName
     * @param array $data
     * @return bool
     */
    public function updateUser(string $userName, array $data): bool
    {
        $response = Http::put(self::HOST . '/user/{$userName}', $data);

        return $response->successful();
    }

    /**
     * Delete user on a third-party service
     *
     * @param string $userName
     * @return bool
     */
    public function deleteUser(string $userName): bool
    {
        $response = Http::delete(self::HOST . '/user/{$userName}');

        return $response->successful();
    }
}
