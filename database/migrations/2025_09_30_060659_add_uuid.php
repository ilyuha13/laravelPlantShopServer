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
        Schema::table('plants', function (Blueprint $table) {
            $table->dropColumn('varieties_id');
            $table->dropColumn('id');
            $table->uuid('id')->primary();
            //
        });
        Schema::table('varieties', function (Blueprint $table) {
            $table->dropColumn('species_id');
            $table->dropColumn('id');
            $table->uuid('id')->primary();
            //
        });
        
        Schema::table('species', function (Blueprint $table) {
            $table->dropColumn('id' );
            $table->uuid('id')->primary();
            //
        });
        Schema::table('varieties', function (Blueprint $table) {
            $table->uuid('species_id');
            $table->foreign('species_id')->references('id')->on('species')->onDelete('cascade');
            //
        });
        Schema::table('plants', function (Blueprint $table) {
            $table->uuid('varieties_id');
            $table->foreign('varieties_id')->references('id')->on('varieties')->onDelete('cascade');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('varieties', function (Blueprint $table) {
            $table->dropForeign(['species_id']);
            $table->dropColumn('species_id');
            //
        });
        Schema::table('plants', function (Blueprint $table) {
            $table->dropForeign(['varieties_id']);
            $table->dropColumn('varieties_id');
            //
        });
        Schema::table('species', function (Blueprint $table) {
            $table->dropColumn('id');
            //
        });
       
    }
};
