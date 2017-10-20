<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'publication_date', 'detail_text', 'user_id', 'picture_id'
    ];

    protected $dates = [
        'publication_date',
    ];

    public function user()
    {
        return $this->belongsTo('App\User') ;
    }
    public function picture()
    {
        return $this->belongsTo('App\Picture') ;
    }
}
