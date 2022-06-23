<?php

namespace Cms\App\Models\Blogs;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'web_blogs_category';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'category',
        'show_in_menu',
        'status'
    ];

    public function blogs(){
        return $this->hasMany('Cms\App\Models\Blogs\Blogs', 'category_id', 'id');
    }
}
