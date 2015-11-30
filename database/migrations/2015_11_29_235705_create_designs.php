<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesigns extends Migration{

    public function up(){
        Schema::create('designs', function(Blueprint $table){
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->string('name')->unique();
            $table->string('description')->nullable();

            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['id', 'project_id', 'name']);
            $table->index(['id', 'created_at', 'updated_at', 'deleted_at']);
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('restrict');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(){
        Schema::drop('designs');
    }
}
