<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVersions extends Migration {

    public function up(){
        Schema::create('versions', function(Blueprint $table){
            $table->increments('id');
            $table->integer('design_id')->unsigned();
            $table->string('filename');

            $table->integer('previous')->unsigned()->nullable();
            $table->integer('next')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('approved_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();


            $table->timestamps();
            $table->timestamp('approved_at')->nullable();
            $table->softDeletes();

            $table->index(['id', 'design_id', 'filename']);
            $table->index(['id', 'approved_by', 'approved_at']);
            $table->index(['id', 'created_at', 'updated_at', 'approved_at', 'deleted_at']);
            $table->foreign('design_id')->references('id')->on('designs')->onDelete('restrict');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(){
        Schema::drop('versions');
    }
}