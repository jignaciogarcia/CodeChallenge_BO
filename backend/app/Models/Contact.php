<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'address',
        'email',
        'cellphoneNumber',
        'profilePictureUrl'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'user_id'
    ];
}
