<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->date('attend_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->tinyInteger('user_type');
            $table->tinyInteger('approval_status')->default('0');
            $table->string('approve_remarks')->nullable();
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
        Schema::dropIfExists('daily_attendances');
    }
}
