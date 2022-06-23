<?php

namespace Cms\App\Models\Pages;

use Illuminate\Database\Eloquent\Model;

class Layouts extends Model
{
    //
    protected $table = 'web_page_layouts';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'label',
        'layout',
        'status',
    ];

    public function templates(){
        return $this->belongsTo('Cms\App\Models\Pages\Templates', 'id', 'layout');
    }
}
