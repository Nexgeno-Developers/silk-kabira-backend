<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->index('created_at', 'visitors_created_at_idx');
            $table->index('company_id', 'visitors_company_id_idx');
            $table->index(['ip_address', 'created_at'], 'visitors_ip_created_at_idx');
        });
    }

    public function down(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropIndex('visitors_created_at_idx');
            $table->dropIndex('visitors_company_id_idx');
            $table->dropIndex('visitors_ip_created_at_idx');
        });
    }
};
