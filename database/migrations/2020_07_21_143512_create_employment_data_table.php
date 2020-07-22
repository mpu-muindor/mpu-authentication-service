<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentDataTable extends Migration
{
    public function up()
    {
        Schema::create('employment_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('department')->comment('Место работы (отдел)');
            $table->string('position')->comment('Должность');
            $table->string('multiplier')->comment('Множитель ставки');
            $table->unsignedBigInteger('professor_id');
            $table->timestamps();

            $table->foreign('professor_id')->references('id')->on('professors')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employment_data');
    }
}
