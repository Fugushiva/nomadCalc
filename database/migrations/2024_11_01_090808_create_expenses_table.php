<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('expenses');
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->enum('category', ['hébergement', 'nourriture', 'transport', 'communication', 'santé']);
            $table->decimal('amount', total:8, places:2);
            $table->enum('currency', ['euro €', 'yuan ¥', 'bath ฿']);
            $table->date('date');
            $table->text('note')->charset('binary'); //BLOB Binary Large OBject
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');

    }
};
