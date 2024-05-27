<?php

namespace App\Http\Controllers;

use App\Http\Response\PublicResponse;
use Litepie\Theme\ThemeAndViews;
use Litepie\User\Traits\RoutesAndGuards;

use Illuminate\Http\Request;

class PublicUserController extends Controller
{

    use ThemeAndViews, RoutesAndGuards;

    /**
     * Initialize public controller.
     *
     * @return null
     */
    public function __construct()
    {
        $this->response = app(PublicResponse::class);
        $this->setTheme('public');
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
