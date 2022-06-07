<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Lumen\Auth\Authorizable;

class Vis_user extends Model
{
    use HasFactory;

    protected $fillable = [
        'username', 'password'
    ];

}


// class Vis_user extends Model implements AuthenticatableContract, AuthorizableContract
// {
//     use Authenticatable, Authorizable, HasFactory;

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var array
//      */
//     protected $fillable = [
//         'name', 'email',
//     ];

//     /**
//      * The attributes excluded from the model's JSON form.
//      *
//      * @var array
//      */
//     protected $hidden = [
//         'password',
//     ];
// }

