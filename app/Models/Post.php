<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Storage;

use App\Models\Category;
use App\Models\Tag;

class Post extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['title', 'description', 'content', 'image', 'published_at','category_id','user_id'];


    public function deleteImage() 
    {
        Storage::delete($this->image);
    }

    public function category() 
    {
       return $this->belongsTo(Category::class);
    }

    public function tags() 
    {
       return $this->belongsToMany(Tag::class);
    }

    // Check if Posts has tags
    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
