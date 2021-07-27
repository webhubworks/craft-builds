<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePluginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plugins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('source_id')->unique();
            $table->string('name');
            $table->string('handle')->unique()->index();
            $table->string('package_name');
            $table->text('short_description')->nullable();
            $table->string('currency');
            $table->string('developer_name');
            $table->text('keywords')->nullable();
            $table->string('version');
            $table->integer('active_installs')->nullable();
            $table->text('icon_url')->nullable();
            $table->boolean('abandoned');
            $table->timestamp('last_update_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plugins');
    }
}
