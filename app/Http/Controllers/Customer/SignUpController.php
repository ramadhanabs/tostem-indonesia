<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Http\Response\PublicResponse;
use Litepie\Theme\ThemeAndViews;
use Litepie\User\Traits\RoutesAndGuards;

class SignUpController extends Controller
{

    use ThemeAndViews, RoutesAndGuards;


    public function __construct()
    {

        $this->response = app(PublicResponse::class);
        $this->setTheme('public');
    }

    public function signUp(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|unique:customers',
            'name' => 'required',
            'password' => 'required',
            'phone_number' => 'required',
        ]);
        $offering = false;
        if ($request['offering'] == 'on') {
            $offering = true;
        }

        $customer = new Customer();
        $customer->email = $request['email'];
        $customer->name = $request['name'];
        $customer->password = Hash::make($request['password']);
        $customer->phone_number = $request['phone_number'];
        $customer->occupation = $request['occupation'];
        $customer->company = $request['company'];
        $customer->position = $request['position'];
        $customer->offering = $offering;


        $customer->save();

        return $this->response
            ->setMetaKeyword("Sign Up Success")
            ->setMetaDescription("")
            ->setMetaTitle("Sign Up Success")
            ->layout('front_page')
            ->view('auth_sign_up_success')
            ->data(['email' => $request['email']])
            ->output();
    }
}
