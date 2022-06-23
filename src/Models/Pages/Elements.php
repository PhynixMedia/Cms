<?php

namespace Cms\App\Models\Pages;

use Illuminate\Database\Eloquent\Model;

class Elements extends Model
{
    //
    protected $table = 'web_page_elements';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'group_id',
        'name',
        'value',
        'type',
        'status',
    ];

    public function groups(){
        return $this->belongsTo('Cms\App\Models\Pages\Groups', 'id', 'group_id');
    }
}
