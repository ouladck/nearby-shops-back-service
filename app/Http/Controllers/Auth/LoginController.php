<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public $successStatus = 200;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login(){

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){

            $user = Auth::user();

            $success['token'] =  $user->createToken('HiddenFounders')->accessToken;
            $success['user'] = $user;

            return response()->json([
                'success' => $success
            ], $this->successStatus);

        }

        else{

            return response()->json(['error'=>'Unauthorised'], 401);

        }

    }

    /**
     * Logout api
     * @return [type]
     */
    public function logout() {}


    /**

     * Register api

     *

     * @return \Illuminate\Http\Response

     */

    public function register(Request $request)

    {

        $validator = Validator::make($request->all(), [

            'name' => 'required',

            'email' => 'required|email|unique:users',

            'password' => 'required',

            'password_confirm' => 'required|same:password',

        ]);



        if ($validator->fails()) {

            return response()->json(['error'=>$validator->errors()], 401);

        }


        $input = $request->all();

        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $success['token'] =  $user->createToken('HiddenFounders')->accessToken;

        $success['user'] =  $user;



        return response()->json(['success'=>$success], $this->successStatus);

    }

}
