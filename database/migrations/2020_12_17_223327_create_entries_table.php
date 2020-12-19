<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->uuid('delete_uuid')->unique();
            $table->enum('state', \App\Enums\State::asArray())->default(\App\Enums\State::Active());
            $table->string('compiler')->nullable()->default(null);
            $table->string('password')->nullable()->default(null);
            $table->longText('content');
            $table->timestamp('expires_at')->nullable()->default(null);
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
        Schema::dropIfExists('entries');
    }
}
