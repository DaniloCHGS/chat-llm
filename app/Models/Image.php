<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    // Definindo a tabela associada, se o nome não for plural do modelo
    protected $table = 'images'; // Nome da tabela no banco de dados

    // Atributos que podem ser preenchidos em massa
    protected $fillable = [
        'content',   // Caminho ou URL da imagem
        'user_id',   // ID do usuário que enviou a imagem
        'prompt_id', // ID do prompt ao qual a imagem está associada
        'created_at',
        'updated_at'
    ];

    // Relacionamentos (opcionais)
    public function prompt()
    {
        return $this->belongsTo(Prompt::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'image_path', 'content');
    }
}
