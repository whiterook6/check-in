<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComments extends Migration {

    public function up()
    {
        Schema::create('comments', function(Blueprint $table){
            $table->increments('id');
            $table->string('body')->nullable();
            $table->morphs('commentable');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['id', 'commentable_id', 'commentable_type']);
            $table->index(['id', 'created_at', 'updated_at', 'deleted_at']);
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::drop('comments');
    }
}
