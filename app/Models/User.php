<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function getAllUsers($page, $userRole='user'){
        $queryAllUsers = User::select( 'name', 'email', 'users.created_at', 'users.id as userId', \DB::raw('count(p.id) as countPhotos'))
                ->leftJoin('photos as p', 'p.created_by', '=','users.id')
                ->where('users.del', 0)
                ->groupBy('name', 'email','users.created_at', 'users.id');
        if($userRole =='user'){ 
            $queryAllUsers->orderBy('countPhotos', 'DESC');
        }else{
            $queryAllUsers->orderBy('created_at', 'DESC');
        }
        
        return $queryAllUsers->paginate($page);
    }

    public static function getUserData($userId){
        return User::where('id',$userId)->first();
    }

    public static function getUserStat(){
        return User::select('name', 'created_at', 'email')
                    ->orderBy('created_at', 'DESC')
                    ->limit(5)
                    ->get();     
    }

    public static function updateUserData($userId, $data){
        return User::where('id', $userId)->update($data); 
    }
}
