<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tableau_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->integer(column: 'order_column');
            $table->timestamps();
        });
        Schema::create('tableau_tableau_tag', function (Blueprint $table) {
            $table->integer('tableau_id')->unsigned();
            $table->integer('tableau_tag_id')->unsigned();
            $table->primary(['tableau_id', 'tableau_tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tableau_tags');
        Schema::dropIfExists('tableaus_tableau_tags');
    }
};
