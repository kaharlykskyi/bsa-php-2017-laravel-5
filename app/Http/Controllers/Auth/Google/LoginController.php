<?php

namespace App\Http\Controllers\Auth\Google;

use App\Entity\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Socialite;

class LoginController extends Controller
{
    /**
    * Redirect the user to the GitHub authentication page.
    *
    * @return Response
    */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Throwable $e) {
            return Redirect::to('auth/google');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return Redirect::to('cars');
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $googleUser
     * @return User
     */
    private function findOrCreateUser($googleUser)
    {
        if ($authUser = User::where('email', $googleUser->email)->first()) {
            return $authUser;
        }

        return User::create([
            'first_name' => $googleUser->name,
            'last_name' => '',
            'email' => $googleUser->email,
            'password' => '',
            'is_active' => true,
            'is_admin' => false,
        ]);
    }

}
