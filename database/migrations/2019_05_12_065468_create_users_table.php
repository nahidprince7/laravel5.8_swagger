<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->integer('employee_id')->comment('user id = empoyee id');
            $table->string('pin', 5);
            $table->string('picture')->nullable()->default(null);
            $table->string('contact_number')->nullable()->default(null);
            $table->string('email', 50)->nullable()->default(null);
            $table->date('joining_date')->nullable()->default(null);
            $table->bigInteger('job_location_id');
            $table->string('password', 180);
//            $table->tinyInteger('role')->default('2')->comment('0=System User, 1=Admin User,2=Employee User');
            $table->tinyInteger('gender')->nullable()->default('1')->comment('1=male, 2=female');
            $table->tinyInteger('religion')->nullable()->default('1');
            $table->tinyInteger('designation_id')->nullable()->default(null)->comment('come from data class currently');
            $table->integer('department_id')->comment('come from database');
            $table->integer('division_id')->nullable()->default(null)->comment('come from database but later');
//            $table->tinyInteger('is_active')->default('1')->comment('1=active, 2=inactive');
            $table->integer('created_by')->default(0)->comment('0=automatically');
            $table->integer('updated_by')->default(0)->comment('0=automatically');
            $table->softDeletes();
            $table->integer('deleted_by')->nullable();
            // $table->dateTimeTz('created_at');
            // $table->dateTimeTz('updated_at')->nullable();
            //$table->unique(["name"], 'name');
            $table->unique(["email"], 'email');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
