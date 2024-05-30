<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('item_section', function (Blueprint $table) {
            $table->string('item_id');
            $table
                ->foreign('item_id')
                ->references('id')
                ->on('items');
            $table->unsignedBigInteger('section_id');
            $table
                ->foreign('section_id')
                ->references('id')
                ->on('sections');
            $table->integer('ord');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_section');
    }
};