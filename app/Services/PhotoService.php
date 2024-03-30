<?php
namespace App\Services;

use App\Models\PhotoModel;
use App\Models\CommentModel;
use Illuminate\Support\Facades\Auth;

class PhotoService 
{
    public $photoDir;

    public function __construct(){
        $this->photoDir = public_path('upload\media\\');
    }

    public function storePhotos($data){
        $insertData = [];
        if(!isset($data->desc)){
            $data->desc = '';
        }
        
        $userId = Auth::id();   
        foreach($data->photos as $photos){
            $fName = $photos->getClientOriginalName();
            $fType = $photos->getClientOriginalExtension();
            $path = $photos->move('uploads/media/', $fName);
            $fSize = $path->getSize();
            array_push($insertData, ['title' =>$data->title,'file_desc' => $data->desc, 'file_name'=>$fName, 'file_size'=>$fSize, 'file_type' => $fType, 'created_by'=>$userId]);
        }
        return PhotoModel::storePhotos($insertData);    
    }

    public function getPhotos($limit, $page){
        $photos = PhotoModel::getPhotos($limit, $page);
        //foreach ($photos as &$photo){
        //    $photo->file_name =  $this->photoDir.$photo->file_name;
        //}
        return $photos;

    }

    public function getSinglePhoto($photoId){
        return PhotoModel::getSinglePhoto($photoId)[0];    
    }

    public function checkAuthor($autId){
        $userId = Auth::id();   
        if($userId == $autId){
            return true;
        }  
        return false; 
    }

    public function storeComment($photoId, $data){
        $insertData = [];
        
        $userId = Auth::id();   
        array_push($insertData, ['comment' =>$data->comment, 'created_by'=>$userId, 'photo_id' => $photoId]);
        return CommentModel::storeComment($insertData);    
    }

    public function deletePhoto($photoId){
        return PhotoModel::deletePhoto($photoId);
    }

    public function deleteFilePhoto($photoId){
        $photo = $this->getSinglePhoto($photoId);
        $image_path = $this->photoDir.$photo->file_name;  // Value is not URL but directory file path
        if(\File::exists($image_path)) {
            \File::delete($image_path);
        }   
    }

    public function getPhotoStat(){
        return PhotoModel::getPhotoStat();
    }

    public function getAllComments($photoId){
        return CommentModel::getAllComments($photoId);
    }

    public function deletePhotoComment($commentId){
        return CommentModel::deletePhotoComment($commentId);
    }

    public function getAllPhotoByUser($userId){
        return PhotoModel::getAllPhotoByUser($userId);
    }
    
    public function countPhotoComments($photoId){
        return CommentModel::getAllComments($photoId)->count();    
    }

    public function countPhotos(){
        $userId = Auth::id();   
        return PhotoModel::getAllPhotoByUser($userId)->count();    
    }


}