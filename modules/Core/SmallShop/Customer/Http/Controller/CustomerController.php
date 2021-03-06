<?php

namespace Modules\Core\SmallShop\Customer\Http\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Model\Customer;

class CustomerController extends Controller
{
    /**
     * Login input validation rules
     * @var array<string, string>
     */
    protected $loginValidation = [
        'email'     => 'required|string',
        'password'  => 'required|string',
    ];
    /**
     * Registration input validation rules
     * @var array<string, mixed>
     */
    protected $regValidation = [
        'first_name'=> ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'email'     => ['required', 'string', 'email', 'max:255', 'unique:customers'],
        'password'  => ['required', 'string', 'min:8', 'confirmed'],
        'phone'     => [            'string', 'min:9', 'max:13'],
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except([ 'logout' ]);
    }

    /**
     * Handle a login request to the application.
     *
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse
    {
        $helpCrtl = app(LoginController::class);
        $attempt = $helpCrtl->login($request);

        if ($attempt) {
            return response()->json([
                'token'     => csrf_token(),
                'message'   => __('auth.success'),
            ]);
        }
    }

    /**
     * Handle a auth check request to the application.
     */
    public function checkAuth(Request $request): JsonResponse
    {
        $result = $this->guard()->check();
        if ($result) {
            /* @var $customer Customer */
            $customer = $this->guard()->customer;
            $result = [
                'id'         => $customer->id,
                'first_name' => $customer->first_name,
                'last_name'  => $customer->last_name,
                'email'      => $customer->email
            ];
        }
        return response()->json($result);
    }

    /**
     * Handle a logout request to the application.
     */
    public function logout(Request $request): JsonResponse
    {
        $helpCrtl = app(LoginController::class);
        $attempt = $helpCrtl->logout($request);

        if ($attempt) {
            $request->session()->regenerateToken();
            return response()->json([
                'token'     => csrf_token(),
                'message'   => __('auth.Logout successful'),
            ]);
        }
    }

    /**
     * Handle a registration request to the application.
     */
    public function register(Request $request): JsonResponse
    {
        $helpCrtl = app(RegisterController::class);
        $attempt = $helpCrtl->register($request);

        if ($attempt) {
            return response()->json([
                'token'     => csrf_token(),
                'message'   => __('auth.Registration successful'),
            ]);
        }
    }

    /**
     * Handle user list request.
     *
     * @throws ValidationException
     */
    public function grid(Request $request): JsonResponse
    {
        if (!Auth::user()->is_admin) {
            throw ValidationException::withMessages(['privilege' => [__('auth.Access not allowed.')]]);
        }
        $perpage = $request->input('per_page', 5);
        $page = $request->input('page', 0)+1;
        $users = User::query()
            ->paginate($perpage == -1 ? PHP_INT_MAX: $perpage, '*', 'page', $perpage == -1 ? 1 : $page)
            ->toArray($request);
        if ($perpage == -1) {
            $users['per_page'] = $perpage;
        }

        return response()->json([
            'message' => '',
            'page' => $users
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     */
    protected function guard(): \Illuminate\Contracts\Auth\StatefulGuard
    {
        return Auth::guard();
    }
}
