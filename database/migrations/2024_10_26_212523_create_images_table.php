<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id(); // ID automático
            $table->string('content'); // Conteúdo da imagem (por exemplo, labels)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID do usuário, com chave estrangeira
            $table->foreignId('prompt_id')->nullable()->constrained()->onDelete('set null'); // ID do prompt, opcional
            $table->string('image_path'); // Caminho da imagem no storage
            $table->enum('role', ['user', 'admin']); // Papel do usuário
            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
