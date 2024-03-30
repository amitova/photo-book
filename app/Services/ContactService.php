<?php
namespace App\Services;

use App\Models\ContactModel;

class ContactService 
{
    public function sendEmail($data){
        ContactModel::create($data->all()); 
   
        \Mail::send('email',
            array(
                'name' => $data->get('name'),
                'email' => $data->get('email'),
                'user_message' => $data->get('message')
            ), function($message)
       {
           $message->from('test@gmail.com');
           $message->to('test@test', 'PhotoBook')->subject('About Photos');
       }); 
    } 
}