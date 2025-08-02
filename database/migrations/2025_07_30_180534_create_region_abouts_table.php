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
       Schema::create('region_about', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained('region')->onDelete('cascade');
            $table->text('isi')->nullable();
            $table->string('logo')->nullable();
            $table->string('foto')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('region_about');
    }
};
