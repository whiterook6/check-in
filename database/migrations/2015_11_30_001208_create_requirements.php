<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirements extends Migration{

    public function up(){
        Schema::create('requirements', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->morphs('requirementable');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('completed_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->timestamp('completed_at')->nullable();
            $table->softDeletes();

            $table->index(['name', 'description']);
            $table->index(['requirementable_id', 'requirementable_type']);
            $table->index(['created_at', 'updated_at', 'completed_at', 'deleted_at'], 'requirements_id_timestamps_index');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('completed_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(){
        Schema::drop('requirements');
    }
}
