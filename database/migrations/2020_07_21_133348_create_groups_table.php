<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('specialty')->comment('Специальность');
            $table->string('specialization')->comment('Специализация');
            $table->string('study_program')->comment('Программа обучения');
            $table->unsignedInteger('study_period')->comment('in month');
            $table->string('study_form')->comment('Форма обучения');
            $table->string('start_year')->comment('Год набора');
            $table->unsignedBigInteger('department_id');

            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
