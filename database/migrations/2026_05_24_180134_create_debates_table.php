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
            Schema::create('debates', function (Blueprint $table) {
                $table->id();
                $table->string('title');   // <-- Il titolo che abbiamo aggiunto prima
                $table->text('message');   // <-- ASSICURATI CHE QUESTA RIGA CI SIA!
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debates');
    }
};
