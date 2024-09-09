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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('img')->nullable();
            $table->string('content');
            $table->unsignedInteger('likes_count')->default(0); // Количество лайков
            $table->unsignedInteger('comments_count')->default(0); // Количество комментариев
            $table->timestamps();
        });
    }
    /*
    user_id INT NOT NULL,               -- Идентификатор автора поста
    title VARCHAR(255) NOT NULL,        -- Заголовок поста
    content TEXT NOT NULL,              -- Содержимое поста
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Дата создания поста
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Дата последнего обновления
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE -- Связь с таблицей пользователей
 */

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
