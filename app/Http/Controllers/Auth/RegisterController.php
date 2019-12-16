<?php

namespace App\Http\Controllers\Auth;

use App\Client;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RedirectController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


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
    protected $redirectTo = '/home';

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
       // dd(request()->header('x-xsrf-token') );
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8']//, 'confirmed'],
//            '_token' => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $client_id = Client::where('client_code' , 'costumer')->first()->id;
//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//        ]);

      //  info("name!!{$data['name']}");
        $id =  User::create([
            'token' =>  '1234556',
            'first_name' =>  explode("@", $data['email'], 2)[0], //$data['name'],
            'client_id' => $client_id, //consumer
            'last_name' => ' ',
            'category_id' => 1,
            'title' => ' ',
            'email' => $data['email'],
            'password' => Hash::make('serenusAI_password_Hash_key=0501'),
        ])->id;

        $user = User::find($id);

        $user->secret_password = 'secret password' ; //$data['password'];
        \Illuminate\Support\Facades\Mail::to('amir1004@gmail.com')->send( new \App\Mail\UserCreated($user));
//        return redirect('/home');
        return $user;
    }
    protected function emailExists(Request $request)
    {
        $messages = [
            'exists' => 'new-user',
        ];

        $request->validate([
//            'email' => 'regex:/^.+@.+$/i|exists:users,email'
            'email' => 'regex:/^.+@.+$/i|unique:users,email'
        ], $messages);
      //  Validator::make($request->all(),$rules);
    }

    public function  pwdLink(Request $request){


        try {
            $this->emailExists($request);
            $user = $this->create($request->all());
        }
        catch (ValidationException $e) {
            if (isset($request->email)) {
                $user = User::findWithEmail($request->email);
                //$token = RedirectController::getToken($user->id);

            }
        //return collect($e->errors()['email'])->flip();
        }

        auth()->loginUsingId($user->id);

        //dd($this->emailExists($request));
        //$user=User::find(227);
        /** @var TYPE_NAME $user */
        $to = explode(",",env('WEBMASTERS') );
        \Illuminate\Support\Facades\Mail::to($to)->send( new \App\Mail\ProcedureLink(103 ));
        return ['message' =>'we have sent you a password link!'];


    }

}
