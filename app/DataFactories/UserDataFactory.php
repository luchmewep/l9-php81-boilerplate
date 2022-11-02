<?php

namespace App\DataFactories;

use Fligno\StarterKit\Abstracts\BaseDataFactory;
use Illuminate\Database\Eloquent\Builder;

// Model
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserDataFactory
 *
 * @author James Carlo Luchavez <jamescarlo.luchavez@fligno.com>
 */
class UserDataFactory extends BaseDataFactory
{
    /**
     * @var string
     */
    public string $first_name;

    /**
     * @var string|null
     */
    public string|null $middle_name = null;

    /**
     * @var string
     */
    public string $last_name;

    /**
     * @var string
     */
    public string $email;

    /**
     * @var string
     */
    public string $password;

    /**
     * @return Builder
     * @example User::query()
     */
    public function getBuilder(): Builder
    {
        return User::query();
    }

    /***** SETTERS *****/

    /**
     * @param string $password
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = Hash::make($password);
    }
}
