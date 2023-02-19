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
        Schema::create('tableaus', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'name');
            $table->string(column: 'slug');
            $table->text(column: 'description');
            $table->integer(column: 'order_column');
            $table->string(column: 'image')->nullable();
            $table->date(column: 'painted_at')->nullable();
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
        Schema::dropIfExists('tableaus');
    }
};
