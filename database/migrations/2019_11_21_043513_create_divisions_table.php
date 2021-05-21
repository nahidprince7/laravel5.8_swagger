<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label');
            $table->tinyInteger('is_active')->default('1');
            $table->integer('created_by')->default(0)->comment('0=automatically');
            $table->integer('updated_by')->default(0)->comment('0=automatically');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('deleted_by')->default(0)->comment('0=automatically');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('divisions');
    }
}
