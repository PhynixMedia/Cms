<?php

namespace Cms\App\Models\Blogs;

use Illuminate\Database\Eloquent\Model;

class Components extends Model
{
    //
    protected $table = 'web_blogs';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'component_id',
        'name',
        'value',
        'status',
    ];

    public function blogs(){
        return $this->belongsTo('Cms\App\Models\Blogs\Blogs', 'id', 'template_id');
    }
}
