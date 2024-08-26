<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use App\Models\Post;

class Image extends Model
{
    use HasFactory, HasEagerLimit;

    protected $fillable = ['id', 'post_id', 'filename','thumbnail', 'created_at', 'updated_at', 'deleted_at'];
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    
    public function isVideo()
    {
        $videoExtensions = ['mp4', 'mov', 'avi', 'mkv']; // Add more video extensions if needed

        $extension = pathinfo($this->filename, PATHINFO_EXTENSION);

        return in_array(strtolower($extension), $videoExtensions);
    }
}
