<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $id)
 * @method static updateOrCreate(string[] $array, int[] $array1)
 */
class CommentImage extends Model
{
    protected $fillable = ['image_name','comment_id'];

}
