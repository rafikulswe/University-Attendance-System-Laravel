<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeAttendanceActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_attendance_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attendance_id')->nullable();
            $table->integer('semister_id')->nullable();
            $table->integer('employee_id');
            $table->date('attend_date')->nullable();
            $table->tinyInteger('user_type');
            $table->integer('assign_advisor_id')->nullable();
            $table->tinyInteger('seen_status')->default('0');
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
        Schema::dropIfExists('employee_attendance_activities');
    }
}
