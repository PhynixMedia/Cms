<?php

namespace Cms\App\Models\Blogs;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    //
    protected $table = 'web_blogs';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'category',
        'title',
        'caption',
        'cover',
        'url',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
    ];

    public function category(){
        return $this->belongsTo('Cms\App\Models\Blogs\Category', 'category', 'id');
    }

    public function components(){
        return $this->hasMany('Cms\App\Models\Blogs\Components', 'component_id', 'id');
    }
}
