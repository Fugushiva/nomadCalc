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
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('category_id')->references('id')->on('categories')->onUpdate('cascade');
            $table->foreignId('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->string('title');
            $table->decimal('amount', total:8, places:2);
            $table->decimal('converted_amount', total:8, places:2)->nullable(true);
            $table->date('date');
            $table->text('note')->charset('binary')->nullable(); //BLOB Binary Large OBject
            $table->timestamps();
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
