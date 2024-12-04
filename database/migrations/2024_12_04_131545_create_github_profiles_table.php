<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('github_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('bio')->nullable();
            $table->string('avatar_url')->nullable();
            $table->integer('public_repos')->nullable();
            $table->integer('followers')->nullable();
            $table->integer('following')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('github_profiles');
    }

};
