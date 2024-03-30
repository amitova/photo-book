<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\PhotoService;
use App\Services\UserService;

class AdminController extends Controller
{
    public function getStatistics(PhotoService $pService, UserService $uService){
        $userStat = $uService->getUserStat();
        $photoStat = $pService->getPhotoStat();
        return view('admin.statistics', ['userStat' => $userStat, 'photoStat' => $photoStat]);
    }

    public function getAllPhotoByUser($userId, PhotoService $service){
        $photos= $service->getAllPhotoByUser($userId);
        return view('admin.userPhotos', ['photos' => $photos]);
    }
}
