<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = ['comment', 'created_by', 'photo_id'];

    public static function storeComment($data){
        return CommentModel::insert($data);
    }

    public static function getAllComments($photoId){
        return CommentModel::where('photo_id', $photoId)->where('del', 0)->orderBy('created_at', 'desc')->get();
    }

    public static function deletePhotoComment($commentId){
        return CommentModel::where('id', $commentId)->update(['del'=> 1]);
    }
}
