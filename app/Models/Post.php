<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Str;


class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id', 'img'];

    public function getExerpt()
    {
        return Str::substr($this->body, 0,200) . " ...";
    }

    public function getExtraExerpt()
    {
        return Str::substr($this->body, 0,50) . " ...";
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function titleExcerpt()
    {
        return Str::substr($this->title, 0, 10) . ' ...';
    }




    
    
}
