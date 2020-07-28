<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceLogsTable extends Migration
{
    public function up()
    {
        Schema::create('service_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('service_id')->nullable()->default(null);
            $table->ipAddress('remote_address');
            $table->string('request_target')->comment('По какому адресу пришёл запрос');
            $table->string('token')->nullable()->default(null);
            $table->boolean('result')->default(false);
            $table->json('params')->nullable();

            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('services')->cascadeOnUpdate()->onDelete('SET NULL');
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_logs');
    }
}
