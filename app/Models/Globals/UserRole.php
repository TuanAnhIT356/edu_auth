<?php
/**
 * Created by PhpStorm.
 * User: tuananh
 * Date: 18/03/2019
 * Time: 16:05
 */

namespace App\Models\Globals;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    public $timestamps = false;
    protected $table = 'user_role';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid',
        'role_id'
    ];

}
