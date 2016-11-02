<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->text('avatar');
            $table->date('bday');
            $table->integer('gender');
            $table->text('course');
            $table->text('major');
            $table->text('contact');
            $table->integer('company_id');
            $table->integer('number_of_hours_rendered');
            $table->text('technology_area');
            $table->string('company_supervisor');
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
        Schema::drop('profiles');
    }
}
