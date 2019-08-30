<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semisters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('semister_name');
            $table->year('year');
            $table->string('version');
            $table->tinyInteger('user_type');
            $table->integer('approval_status')->default('0');
            $table->integer('approved_by')->nullable();
            $table->timestamps();
            $table->tinyInteger('valid')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semisters');
    }
}
