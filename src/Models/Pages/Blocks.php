<?php

namespace Cms\App\Models\Pages;

use Illuminate\Database\Eloquent\Model;

class Blocks extends Model
{
    //
    protected $table = 'web_page_blocks';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'template_id',
        'block_name',
        'multiple',
        'item_max',
        'status',
    ];

    public function templates(){
        return $this->belongsTo('Cms\App\Models\Pages\Templates', 'id', 'template_id');
    }

    public function groups(){
        return $this->hasMany('Cms\App\Models\Pages\Groups', 'block_id', 'id');
    }
}
