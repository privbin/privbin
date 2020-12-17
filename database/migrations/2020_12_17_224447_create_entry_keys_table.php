<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntryKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entry_keys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entry_id')->references('id')->on('entries');
            $table->boolean('read')->default(false);
            $table->boolean('destroy')->default(false);
            $table->string('key');
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
        Schema::dropIfExists('entry_keys');
    }
}
