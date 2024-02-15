<?php

declare(strict_types=1);

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * Constants for messages after import users
     */
    public const USER_CREATED = "пользователь успешно создан";
    public const USER_EXISTS = "текущий пользователь уже существует";

    /**
     * @var Collection
     */
    public $data;

    public function __construct()
    {
        $this->data = collect();
    }

    /**
     * Import
     *
     * @param array $row
     *
     * @return User
     */
    public function model(array $row): User
    {
        $user = User::firstOrCreate([
            'username' => $row['username'],
        ], [
            'username' => $row['username']
        ]);

        $status = $user->wasRecentlyCreated ? self::USER_CREATED : self::USER_EXISTS;
        $this->data->push("{$user->id}:{$status}");

        return $user;
    }
}
