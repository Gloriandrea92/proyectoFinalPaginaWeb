<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Collection;


class UserController extends Controller
{
    public function getSignUp(){
        return view('user.signup');
    }
    public function postSignUp(Request $request){
        $this->validate($request, [
            'email'=>'email|required|unique:users',
            'password'=>'required|min:4'

        ]);
        $user=new User([
            'email'=>$request->input ('email'),
            'password'=>bcrypt ($request->input('password'))
        ]);
        $user->save();
        FacadesAuth::login($user);
        if(session()->has('oldUrl')){
            $oldUrl=session()->get()->oldUrl;
            return redirect()->to($oldUrl);
        }
        return redirect()->route('user.profile');
    }
    public function getSignin(){
        return view('user.signin');
    }
    public function postSignin(Request $request){
        $this->validate($request, [
            'email'=>'email|required',
            'password'=>'required|min:4'

        ]);
        if(FacadesAuth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')])){

            if(session()->has('oldUrl')){
                $oldUrl=session()->get()->oldUrl;
                return redirect()->to($oldUrl);
            }
            return redirect()->route('user.profile');
        }
        return redirect()->back();
    }
    public function getProfile(){
        $orders =FacadesAuth::user()->orders;
        $orders->tranform(function($order,$key){
            $order->cart=unserialize($order ->cart);
            return $order;
        });
        return view('user.profile', ['orders'=>$orders]);
    }
    public function getLogout(){
        FacadesAuth::logout();
        return redirect()->route('user.signin');
    }
}
