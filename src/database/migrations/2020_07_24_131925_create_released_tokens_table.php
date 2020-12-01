<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReleasedTokensTable extends Migration
{
    public function up()
    {
        Schema::create('released_tokens', function (Blueprint $table) {
            $table->string('token', 40)->primary()->comment('токен в sha1');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expired_tokens');
    }
}
