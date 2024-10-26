<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';


    protected $fillable = [
        'content',
        'user_id',
        'prompt_id',
        'created_at',
        'role',
        'image_path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prompt()
    {
        return $this->belongsTo(Prompt::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_path'); // 'id' do modelo Image e 'image_path' no modelo Message
    }
}
