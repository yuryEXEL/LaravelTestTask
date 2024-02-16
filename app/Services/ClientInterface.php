<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Client\Response;

interface ClientInterface
{
    /**
     * Url host server
     */
    public const HOST = 'https://petstore.swagger.io/v2';

    /**
     * Get user by user name
     *
     * @param string $userName
     * @return bool
     */
    public function getUser(string $userName): bool;

    /**
     * @param array $data
     * @return bool|
     */
    public function createUser(array $data): bool;

    /**
     * Update user on a third-party service
     *
     * @param string $userName
     * @param array $data
     * @return bool
     */
    public function updateUser(string $userName, array $data): bool;

    /**
     * Delete user on a third-party service
     *
     * @param string $userName
     * @return bool
     */
    public function deleteUser(string $userName): bool;
}
