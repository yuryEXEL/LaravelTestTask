<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;


class Client
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://petstore.swagger.io/v2';
    }

    public function getUser(string $userName)
    {
        $response = Http::get("{$this->baseUrl}/user/{$userName}");

        if ($response->successful()) {
            return $response->json();
        }

        return false;
    }

    /**
     * @param array $data
     * @return bool|
     */
    public function createUser(array $data)
    {
        $response = Http::post("{$this->baseUrl}/user", $data);

        if ($response->successful()) {
            return $response->json();
        }

        return false;
    }

    /**
     * Create users with list user on a third-party service
     *
     * @param array $data
     * @return bool|Response
     */
    public function createWithArray(array $data)
    {
        $response = Http::post("{$this->baseUrl}/user/createWithArray", $data);

        if ($response->successful()) {
            return $response->json();
        }

        return false;
    }

    /**
     * Create users with list user on a third-party service
     *
     * @param array $data
     * @return bool|Response
     */
    public function createUsersWithList(array $data): bool|Response
    {
        $response = Http::post("{$this->baseUrl}/user/createUsersWithList", $data);

        if ($response->successful()) {
            return $response;
        }

        return false;
    }

    /**
     * Update user on a third-party service
     *
     * @param string $userName
     * @param array $data
     * @return bool|Response
     */
    public function updateUser(string $userName, array $data): bool|Response
    {
        $response = Http::put("{$this->baseUrl}/user/{$userName}", $data);

        if ($response) {
            return true;
        }

        return false;
    }


    /**
     * Delete user on a third-party service
     *
     * @param string $userName
     * @return bool
     */
    public function deleteUser(string $userName): bool
    {
        $response = Http::delete("{$this->baseUrl}/user/{$userName}");
        if ($response->successful()) {
           return true;
        }

        return false;
    }
}
