<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * @method static insert(array $array)
 * @method static where(string $string, int|string|null $id)
 * @method static latest(string $string)
 */
class Post extends Model
{
    //во всяком случае создал, но пока не временно пусть останутся в виде комментов
//    public function postImages(){
//        return $this->hasMany(PostImage::class, 'post_id');
//    }
//
//    public function postLikes(){
//        return $this->hasMany(PostLike::class, 'post_id');
//    }
//
//    public function postComments(){
//        return $this->hasMany(PostComment::class, 'post_id');
//    }
//
//    public function postReposts(){
//        return $this->hasMany(PostRepost::class, 'post_id');
//    }
}
