<?php

namespace App\DataProvider\Eloquent;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $fillablle = [
        'name',
        'address',
    ];
}
