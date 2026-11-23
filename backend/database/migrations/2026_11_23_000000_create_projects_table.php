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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_id', 50)->nullable()->unique();
            $table->enum('division', ['recruitment', 'adm'])->default('recruitment')->index();
            $table->integer('no')->default(1);
            $table->string('date', 20)->nullable()->default('2026-11-11');
            $table->text('name');
            $table->string('principal', 150)->nullable();
            $table->string('pic', 100)->nullable();
            $table->text('activities')->nullable();
            $table->json('stages')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
