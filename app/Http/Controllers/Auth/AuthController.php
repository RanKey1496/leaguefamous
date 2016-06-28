<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Mail;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $redirectPath = 'user';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function postRegister(Request $request){

        $rules = [
            'username' => 'required|min:3|max:16|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|max:18|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->route('users.register')->withErrors($validator)->withInput();
        } else {
            $user = new User;
            $data['username'] = $user->username = $request->username;
            $data['email'] = $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->remember_token = str_random(100);
            $data['confirm_token'] = $user->confirm_token = str_random(100);

            Mail::send('auth.emails.register', ['data' => $data], function($mail) use($data){
                $mail->subject('Confirm your account');
                $mail->to($data['email'], $data['username']);
            });

            Flash::success("We have sent a confirmation e-mail to " .$user->email);
            $user->save();
            return redirect()->route('users.register');
        }

    }

    public function confirmRegister($email, $confirm_token){
         $user = new User;
         $the_user = $user->select()->where('email', '=', $email)
           ->where('confirm_token', '=', $confirm_token)->get();
         
         if (count($the_user) > 0){
              $active = 1;
              $confirm_token = str_random(100);
              $user->where('email', '=', $email)->update(['active' => $active, 'confirm_token' => $confirm_token]);
              Flash::success('Good one ' . $the_user[0]['username'] . ' you can sign now');
              return redirect()->route('users.register');
         }
         else
         {
            return redirect('');
         }
    }

    public function postLogin(Request $request){
        if (Auth::attempt(
            [
            'email' => $request->email,
            'password' => $request->password,
            'active' => 1
            ]
            , $request->has('remember')
            )){
            return redirect()->intended($this->redirectPath());
        }else{
            $rules = [
            'email' => 'required|email',
            'password'  => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            Flash::error("The e-mail/password is invalid");
            return redirect()->route('users.login')->withErrors($validator)->withInput();
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }

}
