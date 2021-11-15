<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static insert(array $array)
 * @method static where(string $string, $postId)
 * @method static get()
 */
class PostComment extends Model
{
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id','writer_user_id'); //localkey - is not the column of your User model
                                                                                          //in our case it's the column of our PostComment model
                                                                                          //User is the PostComment's relation
    }

    public function dependentComments(): HasMany
    {
        return $this->hasMany(PostComment::class, 'receiver_comment_id');
    }

    public function image(): HasOne{
        return $this->hasOne(CommentImage::class, 'comment_id');
    }
}
