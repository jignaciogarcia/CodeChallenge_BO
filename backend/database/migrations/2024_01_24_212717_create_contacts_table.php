<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary(['id']);
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('cellphoneNumber')->nullable();
            $table->string('profilePictureUrl')->nullable();
            $table->string('title')->nullable();
            $table->timestamps();
            $table->foreignUuid('user_id')
            ->references('id')
            ->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
