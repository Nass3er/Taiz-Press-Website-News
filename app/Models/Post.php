<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Models\Image;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
class Post extends Model  implements TranslatableContract ,Viewable
{
    use SoftDeletes, HasFactory, Translatable,InteractsWithViews  ;
    public $translatedAttributes = ['title', 'content','smallDesc','tags','slug','link'];
    protected $fillable = ['id', 'image', 'category_id', 'created_at', 'updated_at', 'deleted_at','user_id'];

   public function category(){
    return $this->belongsTo(Category::class, 'category_id');

   }

   public function user(){
    return $this->belongsTo(User::class, 'user_id');

   }

   public function images()
   {
       return $this->hasMany(Image::class);
   }
}
