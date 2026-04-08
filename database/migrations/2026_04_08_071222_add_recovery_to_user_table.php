<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user', function (Blueprint $table) {

            $table->string('recovery_key', 50)->nullable()->after('password');

            $table->boolean('must_change_password')
                  ->default(true)
                  ->after('recovery_key');

        });
    }

    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {

            $table->dropColumn('recovery_key');

            $table->dropColumn('must_change_password');

        });
    }
};