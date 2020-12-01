<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->unsignedBigInteger('faculty_id');

            $table->foreign('faculty_id')->references('id')->on('faculties');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cathedras');
    }
}
