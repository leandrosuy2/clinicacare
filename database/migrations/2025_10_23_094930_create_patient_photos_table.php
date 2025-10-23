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
        Schema::create('patient_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->string('photo_path');
            $table->string('photo_type')->default('evolution'); // 'profile' ou 'evolution'
            $table->text('description')->nullable();
            $table->decimal('weight', 5, 2)->nullable(); // Peso no momento da foto
            $table->date('photo_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_photos');
    }
};
