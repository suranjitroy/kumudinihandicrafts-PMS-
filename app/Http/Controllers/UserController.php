<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function LoginPage(){
        return view('pages.auth.login-page');
    }
    public function RegistrationPage(){
        return view('pages.auth.registration-page');
    }


    public function userRegistration(Request $request){

        try{
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Registrarion Successfull'
            ],200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ],200);
        }
            
    }

    public function tokenCreate(){
        try{
            $user = User::first();

            $token = $user->createToken('suranjit');
            return $token;
        }catch(Exception $e){

            return response()->json([
                'status' => 'Failed',
                'message' => $e->getMessage()
            ]);
    }

}
public function userList(){
    try{

        $user = User::all();
        return $user;

    }
    catch(Exception $e){

        return response()->json([
            'status' => 'Failed',
            'message' => $e->getMessage()
        ]);
}
}
public function getUser(){

    $user =  Auth::user()['name'];
        return $user;

    
}
public function userLogin(Request $request){
        	
    try{

        $request->validate([
            'email' => 'required|email',
            'password' =>'required|string|min:5'
        ]);

        $email = $request->input('email');
        
        $user = User::where('email', $email)->first();



        if(!$user || !Hash::check($request->input('password'), $user->password)){

            return response()->json([
                'status' => 'Failed',
                'message' => 'Invalid User'
            ]);

        }else{

            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'User Loged in successfull',
                'token' => $token
            ],200);

        }


    }catch(Exception $e){
        return response()->json([
            'status' => 'Login Failed',
            'message' => $e->getMessage()
        ]);
    }

}

public function userLogout(Request $request){
    $request->user()->tokens()->delete();
    return redirect('/userLogin');
}   

public function userProfilePage(){
    return view('pages.dashboard.dashboard-page');
}

function UserGetProfile(Request $request){
    $user =  Auth::user();

    return $user;
    //dd($user);

}

}