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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->dateTime('datetime');
            $table->decimal('weight', 8, 2);
            $table->string('dimensions');
            $table->string('from_address');
            $table->string('to_address');
            $table->enum('cargo_type', [
                'fragile', 'perishable', 'refrigerated',
                'animals', 'liquid', 'furniture', 'garbage'
            ]);
            $table->enum('status', ['new', 'in_progress', 'completed', 'canceled'])->default('new');
            $table->boolean('needs_disposal')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
