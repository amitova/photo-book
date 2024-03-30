<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoModel extends Model
{
    use HasFactory;
    protected $table = 'photos';
    protected $fillable = ['title', 'file_desc', 'file_name', 'file_type', 'file_size', 'created_by'];

    public static function storePhotos($data){
        return PhotoModel::insert($data);
    }

    public static function getPhotos($limit, $page){
        $photos =  PhotoModel::where('del', 0)->orderBy('created_at', 'desc');
        if($limit > 0){
            return $photos->limit($limit)->get();
        }
        return $photos->paginate($page);
    }  

    public static function getSinglePhoto($photoId){
        return PhotoModel::select('u.name', 'photos.*')->join('users as u','u.id','created_by')->where('photos.id',$photoId)->get();
    }

    public static function deletePhoto($photoId){
        return PhotoModel::where('photos.id', $photoId)->update(['del' => 1]);

    }
    public static function getPhotoStat(){
        return PhotoModel::select('u.name', 'photos.*')
                        ->join('users as u','u.id','created_by')
                        ->orderBy('photos.created_at', 'DESC')
                        ->limit(5)
                        ->get();    
    }

    public static function getAllPhotoByUser($userId){
        return PhotoModel::where('created_by', $userId)->paginate(10);    
    }
}
