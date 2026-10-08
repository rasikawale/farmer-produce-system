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
        Schema::table('buyers', function (Blueprint $table) {
            $table->string('name');
            $table->string('mobile')->unique();
            $table->string('password');
            $table->string('city')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('buyers', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'mobile',
                'password',
                'city',
                'latitude',
                'longitude',
            ]);
        });
    }
};
