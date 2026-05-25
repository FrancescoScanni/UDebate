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
            //creazione tabella dibattiti con chiave esterna verso utenti e campi titolo messaggio e timestamp
            Schema::create('debates', function (Blueprint $table) {
                $table->id();
                $table->string('title');  
                $table->text('message');  
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->timestamps();
            });
        }

    public function down(): void
    {
        Schema::dropIfExists('debates');
    }
};
