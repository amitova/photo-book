<?php

namespace App\Http\Controllers;
use App\Services\UserService;
use App\Http\Requests\EditUserRequest;

class UserController extends Controller
{
    

    public function showUsers(UserService $service){
        $users = $service->getAllUsers();
        return view('usersList', ['users' => $users]);
    }

    public function showUserProfile(UserService $service){
        $userData = $service->getUserData();
         return view('user.profile', ['user' => $userData]);
    }

    public function updateUserData(EditUserRequest $request, UserService $service){
        try{
            $service->updateUserData($request);
            return redirect()->back()->with('success', 'It\'s Done!');
        }catch(Exception $e){
            \Log::error('Upload files error - '.$e);
            return redirect()->back()->withErrors('error', 'Something went wrong!');
        }
    }

}
