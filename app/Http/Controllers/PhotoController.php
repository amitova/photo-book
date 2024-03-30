<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

use App\Http\Requests\StorePhotosRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Services\PhotoService;

class PhotoController extends Controller
{
    public function index(PhotoService $service){
        $limit=10;
        $photos = $service->getPhotos($limit, $page=0);
        
        return view('home', ['photos' => $photos]);
    }  

    public function addPhotos(){
        return view('user.addPhotos');
    }  

    public function storePhotos(StorePhotosRequest $request, PhotoService $service)
    {
        $countPhotos = $service->countPhotos();
        
        try{
            if($countPhotos>=10){
                //dd($countPhotos);
                $errMsg = "The allowed max number of photos is 10. You have added already ". $countPhotos;
                return redirect()->back()->with('error', $errMsg);
            }
            $service->storePhotos($request);
            return redirect()->back()->with('success', 'It\'s Done!');
        }catch(Exception $e){
            \Log::error('Upload files error - '.$e);
            return redirect()->back()->withErrors('error', 'Something went wrong!');
        }
    }  

    public function showAllPhotos(PhotoService $service){
        
        $photos = $service->getPhotos($limit=0, $page=10);
        return view('photos', ['photos' => $photos]);
    }

    public function showSinglePhoto($photoId, PhotoService $service){
        $photo = $service->getSinglePhoto($photoId);
        $author = $service->checkAuthor($photo->created_by);
        $comments = $service->getAllComments($photoId);
        return view('singlePhoto', ['photo' => $photo, 'author' => $author, 'comments' => $comments]);
    }

    public function storeComment($photoId, StoreCommentRequest $request, PhotoService $service)
    {
        $countComments = $service->countPhotoComments($photoId);
        try{
            if($countComments>=10){
                return redirect()->back()->with('error', 'The allowed max number of comments is 10');
            }
            $service->storeComment($photoId, $request);
            return redirect()->back()->with('success', 'It\'s Done!');
        }catch(Exception $e){
            \Log::error('Add comment error - '.$e);
            return redirect()->back()->withErrors('error', 'Something went wrong!');
        }
    }  

    public function deletePhoto( $photoId, PhotoService $service)
    {
        try{
            $service->deletePhoto($photoId);
            $service->deleteFilePhoto($photoId);
            return redirect('photos')->with('success', 'It\'s Done!');
        }catch(Exception $e){
            \Log::error('Delete photo error - '.$e);
            return redirect()->back()->withErrors('error', 'Something went wrong!');
        }
    }
    
    public function deleteComment( $commentId, PhotoService $service)
    {
        try{
            $service->deletePhotoComment($commentId);
            return  redirect()->back()->with('success', 'It\'s Done!');
        }catch(Exception $e){
            \Log::error('Delete comment error - '.$e);
            return redirect()->back()->withErrors('error', 'Something went wrong!');
        }
    }
}
