<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('pk_id');
            $table->text('description');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->boolean('is_billable');
            $table->boolean('is_active');
            $table->enum('task_set', ['tasks']);
            $table->timestamps();
        });
        
        /** What JSON JSONB does:
         * SELECT '{"c":0,   "a":2,"a":1}'::json, '{"c":0,   "a":2,"a":1}'::jsonb;

                        json          |        jsonb 
              ------------------------+--------------------- 
               {"c":0,   "a":2,"a":1} | {"a": 1, "c": 0} 
         */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
