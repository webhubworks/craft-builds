<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('build_plugin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('build_id')->constrained()->cascadeOnDelete();
            $table->foreignId('plugin_id')->constrained()->cascadeOnDelete();
            $table->foreignId('edition_id')->constrained()->cascadeOnDelete();
        });
    }
};
