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
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string("splynx_id")->default(null);
            $table->string("easypay_number")->default(0);
            $table->string("username")->default("");
            $table->string("password")->default("");
            $table->string("name");
            $table->string("surname");
            $table->string("email");
            $table->string("phonenumber");
            $table->string("street");
            $table->string("city");
            $table->string("zip_code");
            $table->string("tarrif"); 
            $table->string("agreed-terms"); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
