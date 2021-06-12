<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticateContract;

use Laravel\Passport\HasApiTokens; // Add this line


class Author extends Model implements AuthenticateContract
{
    use HasFactory, HasApiTokens, Authenticatable;

    protected $fillable = [
        'email', 
        'name',
        'phone_no',
        'password',
    ];

    protected $hidden = [
        'password'
    ];

    public $timestamps = false;
}
