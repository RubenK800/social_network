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
    public function images(){
        return $this->hasMany(PostImage::class, 'post_id');
    }
//
//    public function postLikes(){
//        return $this->hasMany(PostLike::class, 'post_id');
//    }
//
    public function comments(){
        return $this->hasMany(PostComment::class, 'post_id')->where('receiver_comment_id',0);
    }
//
//    public function postReposts(){
//        return $this->hasMany(PostRepost::class, 'post_id');
//    }
}
