<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('contact');
            $table->text('remarks');
            $table->integer('question_id');
            $table->integer('question_option_id');
            $table->integer('perseption_id');
            $table->integer('project_id');
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
        Schema::dropIfExists('customer_responses');
    }
}
