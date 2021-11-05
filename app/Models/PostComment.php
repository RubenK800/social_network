<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * @method static insert(array $array)
 * @method static where(string $string, $postId)
 * @method static get()
 */
class PostComment extends Model
{
    public function user(){
        return $this->hasOne(User::class, 'id','writer_user_id'); //localkey - is not the column of your User model
                                                                                          //in our case it's the column of our PostComment model
                                                                                          //User is the PostComment's relation
    }
}
