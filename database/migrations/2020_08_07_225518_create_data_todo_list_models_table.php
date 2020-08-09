<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTodoListModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_todo_list', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by_user_id')->index('created_by_user_id')->nullable();
            $table->string('title');
            $table->text('description');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('data_todo_list', function (Blueprint $table) {
            $table->foreign('created_by_user_id')->references('id')->on('data_users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('data_todo_list', function (Blueprint $table) {
        //     $table->dropForeign('created_by_user_id');
        // });

        Schema::dropIfExists('data_todo_list');
    }
}
