<?php

namespace App\Http\Controllers\Customer;

use App\Http\Response\PublicResponse;
use Litepie\Theme\ThemeAndViews;
use Litepie\User\Traits\RoutesAndGuards;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Customer;
use Auth;

class CustomerController extends Controller
{

    use ThemeAndViews, RoutesAndGuards;

    /**
     * Initialize public controller.
     *
     * @return null
     */
    public function __construct()
    {

        $this->middleware('auth:customer.web');
        $this->response = app(PublicResponse::class);
        $this->setTheme('public');
    }




    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }








    public function account()
    {

        return $this->response
            ->setMetaKeyword('My Account')
            ->setMetaDescription('User Account')
            ->setMetaTitle("My Account")
            ->layout('front_page')
            ->view('user.user_account')
            ->output();
    }

    public function wishlist()
    {
        return $this->response
            ->setMetaKeyword('Wishlist')
            ->setMetaDescription('Wishlist')
            ->setMetaTitle('Wishlist')
            ->layout('front_page')
            ->view('user.user_wishlist')
            ->output();
    }
}
