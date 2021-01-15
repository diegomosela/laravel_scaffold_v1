<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoView extends Model
{
    use HasFactory;

    protected $table = 'videos_views';

    public $timestamps = false;
    
}
