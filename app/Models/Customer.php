<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;


class Customer extends Model
{
    use HasFactory;
    use \Illuminate\Auth\Authenticatable;

    protected $guarded = [];
}

