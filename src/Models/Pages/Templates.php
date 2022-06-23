<?php

namespace Cms\App\Models\Pages;

use Illuminate\Database\Eloquent\Model;

class Templates extends Model
{
    //
    protected $table = 'web_page_templates';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'title',
        'url',
        'label',
        'parent',
        'layout',
        'category',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'header_position',
        'footer_position',
        'page_order',
        'status',
    ];

    public function blocks(){
        return $this->hasMany('Cms\App\Models\Pages\Blocks', 'template_id', 'id');
    }

    public function layouts(){
        return $this->hasMany('Cms\App\Models\Pages\Layouts', 'id', 'layout');
    }
}
