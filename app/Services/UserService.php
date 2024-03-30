<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService 
{
    public function getAllUsers(){
        $page=10;
        $userRole = Auth::user()->role;
        return User::getAllUsers($page, $userRole);    
    } 

    public function getUserData(){
        $userId = Auth::id();   
        return User::getUserData($userId);
    }

    public function updateUserData($data){
        $userId = Auth::id();
        $password = \Hash::make($data->password);
        $dataInsert = ['name' => $data->name, 'password' => $password];
        return User::updateUserData($userId, $dataInsert); 
    }

    public function getUserStat(){
        return User::getUserStat();    
    } 

}