<?php

namespace App\Models;
use App\Models\VideoTestimony;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function video_testimonies()
    {
        return $this->hasMany(VideoTestimony::class,'categories_id');
    }
}
