<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * @method static insert(array $array)
 * @method static where(string $string, int|string|null $userId)
 */
class Avatar extends Model
{
    protected $table = 'users_avatars';
}
