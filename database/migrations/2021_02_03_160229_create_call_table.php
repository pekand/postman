<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('request_id');
            $table->foreign('request_id')->references('id')->on('requests');

            $table->string('url');
            $table->string('method');
            $table->text('params')
                ->charset('utf8')
                ->collation('utf8_unicode_ci');
            $table->text('response')
                ->charset('utf8')
                ->collation('utf8_unicode_ci');
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
        Schema::dropIfExists('calls');
    }
}
