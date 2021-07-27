<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('source_id')->unique();
            $table->foreignId('plugin_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('handle')->index();
            $table->integer('price')->nullable();
            $table->integer('renewal_price')->nullable();
            $table->json('features')->nullable();
            $table->timestamps();

            $table->unique(['handle', 'plugin_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('editions');
    }
}
