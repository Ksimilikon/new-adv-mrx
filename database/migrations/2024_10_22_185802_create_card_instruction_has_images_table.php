<?php

use App\Models\CardInstruction;
use App\Models\Image;
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
        Schema::create('card_instruction_has_images', function (Blueprint $table) {
            $table->foreignIdFor(CardInstruction::class);
            $table->foreignIdFor(Image::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_instruction_has_images');
    }
};
