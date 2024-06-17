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
        Schema::table('items', function (Blueprint $table) {
            $table->json('title')->nullable();
            $table->json('author')->nullable();
            $table->json('dating')->nullable();
            $table->json('medium')->nullable();
            $table->json('measurement')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('author');
            $table->dropColumn('dating');
            $table->dropColumn('medium');
            $table->dropColumn('measurement');
        });
    }
};
