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
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->timestamps();
        });

        Schema::table("users", function (Blueprint $table){
            $table->foreignId('roles_id')
                  ->after('email')
                  ->default(1)
                  ->constrained('user_roles')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table){
            $table->dropForeign(['roles_id']);
            $table->dropColumn('roles_id');
        });
        Schema::dropIfExists('user_roles');
    }
};
