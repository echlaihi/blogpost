<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use function GuzzleHttp\Psr7\str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id', 'img'];

    public function getExerpt()
    {
        return Str::substr($this->body, 0,200) . " ...";
    }
}
