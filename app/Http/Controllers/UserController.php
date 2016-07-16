<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Laracasts\Flash\Flash;
use Validator;
use App\User;
use Auth;
use Hash;
use Response;


class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function user(){
        return View('user.user');
    }

    public function profile(){
        return View('user.profile');
    }

    public function updateProfile(Request $request){
        $rules = ['image' => 'required|image|max:300*300*1',];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            Flash::warning($validator);
            return redirect()->route('users.edit.profile');
        } else {
            $name = str_random(30) . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move('profiles', $name);
            $user = new User;
            $user->where('email', '=', Auth::user()->email)->update(['profileImage' => 'profiles/'.$name]);
            Flash::success("Your profile picture has been changed successfully!");
            return redirect()->route('users.panel');
        }
    }

    public function updateAvatar(Request $request){
        $img = $request->file('image'); // Your data 'data:image/png;base64,AAAFBfj42Pj4';
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);

            $name = str_random(30) . '-' . Auth::user()->id;
            $data->move('profiles', $name);
            dd($data);
            $user = new User;
            $user->where('email', '=', Auth::user()->email)->update(['profileImage' => 'profiles/'.$name]);
            return Response::json(array('result'=>'1','isUpdated'=>'1','text'=>'Avatar Update'));
    }

    public function password(){
        return View('user.password');
    }

    public function updatePassword(Request $request){
        $rules = [
            'mypassword'    =>  'required',
            'password'      =>  'required|confirmed|min:6|max:18',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            Flash::success($validator);
            return redirect()->route('users.edit.password');
        } else {
            if (Hash::check($request->mypassword, Auth::user()->password)){
                $user = new User;
                $user->where('email', '=', Auth::user()->email)->update(['password' => bcrypt($request->password)]);
                Flash::success("Your password has been changed successfully!");
                return redirect()->route('users.panel');
            } else {
                Flash::success("Please make sure you have entered the information correctly");
                return redirect()->route('users.edit.password');
            }
        }
    }

    public function settings(){
        return View('user.settings');
    }
}
