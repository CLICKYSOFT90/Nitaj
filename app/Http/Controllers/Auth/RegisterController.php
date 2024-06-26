<?php

namespace App\Http\Controllers\Auth;

use App\Events\NewUserMail;
use App\Http\Controllers\Controller;
use App\Models\UserWallets;
use App\Models\WalletLogs;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Traits\HasRoles;
use Event;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use HasRoles;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobile' => ['required'],
            'accept_tnc' => ['required'],
            'investor_type' => ['required'],
//            'type' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'mobile' => '+966'.$data['mobile'],
//            'country' => $data['country'],
//            'city' => $data['city'],
//            'zip_code' => $data['zip'],
        ]);
        $wallet = new UserWallets();
        $wallet->user_id = $user->id;
        $wallet->amount = 30000;
        $wallet->deducted_amount = 0;
        $wallet->save();
        $wallet_logs = new WalletLogs();
        $wallet_logs->amount = 30000;
        $wallet_logs->type = 'deposit';
        $wallet_logs->save();
        $user->assignRole($data['investor_type']);
        NewUserMail::dispatch(1);
        return $user;
    }

    public function fakeData(Request $request)
    {
        $faker = Factory::create();
        $data['first_name'] = $faker->text(10);
        $data['second_name'] = $faker->text(10);
        $data['third_name'] = $faker->text(10);
        $data['last_name'] = $faker->text(10);
        $data['id_expire'] = $faker->date('Y-m-d');
        $data['gender'] = $faker->text(10);
        $data['unit_address'] = $faker->text(10);
        $data['building_number'] = $faker->text(10);
        $data['street_name'] = $faker->text(10);
        $data['district'] = $faker->text(10);
        $data['city'] = $faker->text(10);
        $data['postal_code'] = $faker->numberBetween(10, 500);
        $data['additional_code'] = $faker->numberBetween(10, 500);
        $data['location'] = $faker->text(10);
        return $data;
    }
}
