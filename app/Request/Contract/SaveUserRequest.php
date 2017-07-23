<?php

namespace App\Request\Contract;

use App\Entity\User;

interface SaveUserRequest
{
    /**
     * @return string|null
     */
    public function getFirstName();

    /**
     * @return string|null
     */
    public function getLastName();

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @return bool
     */
    public function getIsAdmin(): bool;

    /**
     * @return string
     */
    public function getPassword();

    /**
     * @return bool
     */
    public function getIsActive(): bool;

    /**
     * @return User
     */
    public function getUser(): User;
}