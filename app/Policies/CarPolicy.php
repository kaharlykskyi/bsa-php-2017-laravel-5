<?php

namespace App\Policies;

use App\Entity\User;
use App\Entity\Car;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarPolicy
{
    use HandlesAuthorization;

    /**
     * Policy for delete car action.
     * Only admins can delete cars
     *
     * @return bool
     */
    public function deleteCar(User $user)
    {
        if ($user->is_admin == true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Policy for edit car action.
     * Only admins can edit cars
     *
     * @return bool
     */
    public function editCar(User $user)
    {
        if ($user->is_admin == true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Policy for create car action.
     * Only admins can create cars
     *
     * @return bool
     */
    public function createCar(User $user)
    {
        if ($user->is_admin == true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Policy for view admin api.
     * Only admins can view admins api
     *
     * @param User $user
     * @return bool
     */
    public function actionWithAdminApi(User $user)
    {
        if ($user->is_admin == true) {
            return true;
        } else {
            return false;
        }
    }

}
