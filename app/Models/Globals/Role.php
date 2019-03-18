<?php
/**
 * Created by PhpStorm.
 * User: tuananh
 * Date: 18/03/2019
 * Time: 15:58
 */

namespace App\Models\Globals;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;
    protected $table = 'role';

    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;

    CONST OPERATOR      = 23;
    CONST OPERATOR_IN   = 24;
    CONST OPERATOR_ADMIN= 25;
    CONST MARKETING     = 16;
    CONST SALES         = 15;
    CONST SALES_ADMIN   = 13;
    CONST MANAGE        = 1;
    CONST CUSTOMER_CARE = 17;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role',
        'status'
    ];
}
