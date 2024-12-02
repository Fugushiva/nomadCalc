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
        Schema::create('expense_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expense_id')->references('id')->on('expenses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('tag_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expense_tag', function(Blueprint $table){
            $table->dropForeign(['tag_id']);
        });

        Schema::table('expense_tag', function(Blueprint $table){
            $table->dropForeign(['expense_id']);
        });
        Schema::dropIfExists('expense_tag');
    }
};
