<?php

namespace Cms\App\Models\Pages;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    //
    protected $table = 'web_page_groups';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        "id",
        'block_id',
        'group_name',
        'status',
    ];

    public function blocks(){
        return $this->belongsTo('Cms\App\Models\Pages\Blocks', 'id', 'block_id');
    }

    public function elements(){
        return $this->hasMany('Cms\App\Models\Pages\Elements', 'group_id', 'id');
    }

}
