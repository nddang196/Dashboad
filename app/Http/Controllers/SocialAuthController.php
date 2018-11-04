<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use App\User;

class SocialAuthController extends Controller
{
    /**
     * Chuyển hướng người dùng sang OAuth Provider.
     *
     * @param $provider
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function redirectToProvider($provider)
    {
        if(!Session::has('pre_url')){
            Session::put('pre_url', URL::previous());
        }else{
            if(URL::previous() != URL::to('login')) Session::put('pre_url', URL::previous());
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Lấy thông tin từ Provider, kiểm tra nếu người dùng đã tồn tại trong CSDL
     * thì đăng nhập, ngược lại nếu chưa thì tạo người dùng mới trong SCDL.
     *
     * @param $provider
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);

        return Redirect::to(Session::get('pre_url'));
    }

    /**
     * @param $user
     * @param $provider
     *
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();

        if ($authUser) {
            return $authUser;
        }

        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'email_verified_at' => time(),
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }
}
