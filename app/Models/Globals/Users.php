<?php
/**
 * Created by PhpStorm.
 * User: tuananh
 * Date: 18/03/2019
 * Time: 14:22
 */

namespace App\Models\Globals;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{

    public    $timestamps = false;
    protected $table      = 'users';

    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE     = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'email',
        'default_language',
        'admin_system',
        'access_url',
        'is_agent',
        'is_referer',
        'company_id',
        'is_agency',
        'get_order',
        'max_call',
        'send_licence',
        'is_viettel',
        'viettel_post',
        'group_id_permission_get_new_order',
        'login_time',
        'status',
        'created'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
