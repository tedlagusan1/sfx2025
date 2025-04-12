<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email_verification_token', 100)->nullable()->after('email');
            $table->timestamp('email_validated_at')->nullable()->after('email_verification_token');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email_verification_token');
            $table->dropColumn('email_validated_at');
        });
    }
};
