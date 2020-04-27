<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Model\User;
use App\Model\Customer;
use App\Model\Customer\Address;
use App\Model\Customer\Card;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Validator as CValidator;

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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;

    /**
     * Login input validation rules
     * @var string[]
     */
    protected static $loginValidation = [
        'email'     => 'required|string',
        'password'  => 'required|string',
    ];
    /**
     * Registration input validation rules
     * @var string[][]
     */
    protected static $regValidation = [
        'first_name'=> ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password'  => ['required', 'string', 'min:8', 'confirmed'],
        'phone'     => [            'string', 'min:9', 'max:13'],

        'address.street'    => ['required', 'string'],
        'address.street_nr' => ['required', 'string'],
        'address.city'      => ['required', 'string'],
        'address.zip'       => ['required', 'string'],
        'address.country'   => ['required', 'string'],
    ];

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return CValidator
     */
    protected function validator(array $data): CValidator
    {
        return Validator::make($data, self::$regValidation);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param string[][] $data
     * @return User|null
     */
    protected function create(array $data): ?User
    {
        //!! START TRANSACTION !!!
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => '*temp_name*',
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $customer = Customer::make([
                'first_name'    => $data['first_name'],
                'last_name'     => $data['last_name'],
                'registered_at' => now(),
                'phone'         => $data['phone'],
            ]);
            $customer->user()->associate($user)->save();

            $user->name = strtolower(str_replace(' ', '_', $customer->fullName()));
            //$user->name = 'customer_' . $customer->id;
            $user->save();

            $address = Address::make([
                'street'      => $data['address']['street'],
                'street_nr'   => $data['address']['street_nr'],
                'city'        => $data['address']['city'],
                'zip'         => $data['address']['zip'],
                'country'     => $data['address']['country'],
            ]);
            $address->customer()->associate($customer)->save();

            if ($data['card_ids']) {
                $card_data = array_map(function (string $item) use ($customer) {
                    $item = intval($item);
                    return [
                        'customer_id' => $customer->id,
                        'card_id'     => $item,
                    ];
                }, explode(',', $data['card_ids']));
                Card::query()->insert($card_data);
            }
            DB::commit();
            return $user;
        } catch (\Exception $ex) {
            DB::rollBack();
        }
        return null;
    }
}
