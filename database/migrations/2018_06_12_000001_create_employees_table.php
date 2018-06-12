<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'employees';

    /**
     * Run the migrations.
     * @table employees
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('full_name');
            $table->integer('title_id')->nullable()->references('id')->on('title')->onDelete('CASCADE');
            $table->timestamp('hire_date')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->integer('salary');
            $table->unsignedInteger('_lft')->default('0');
            $table->unsignedInteger('_rgt')->default('0');
            $table->unsignedInteger('parent_id')->nullable()->default(null);
            $table->string('image')->nullable()->default(null);

            $table->index(["_lft", "_rgt", "parent_id"], 'employees__lft__rgt_parent_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
