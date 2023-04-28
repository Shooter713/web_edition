<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class NewsTags extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $timestamps = false;

    protected $fillable = [
        'news_id',
        'tags_id',
    ];

    public function tags()
    {
        return $this->hasOne(Tags::class, 'id', 'tags_id');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'id', 'news_id');
    }
}
