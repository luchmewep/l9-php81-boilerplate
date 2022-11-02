<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Models\LaratrustTeam;

class Team extends LaratrustTeam
{
    use HasFactory;
    use SoftDeletes;

    public $guarded = [];
}
