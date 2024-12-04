<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFields extends Migration
{
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->integer('public_repos')->nullable(); // Repositórios públicos
            $table->integer('private_repos')->nullable(); // Repositórios privados (observação: você precisa de um token para acessar repositórios privados)
            $table->integer('stars')->nullable(); // Número de estrelas
            $table->integer('followers')->nullable(); // Número de seguidores
            $table->integer('following')->nullable(); // Número de seguidos
            $table->json('achievements')->nullable(); // Achievements (se houver)
        });
    }

    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'public_repos',
                'private_repos',
                'stars',
                'followers',
                'following',
                'achievements',
            ]);
        });
    }
}
