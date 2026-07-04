<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('companies', 'footer_logo_image')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->dropColumn('footer_logo_image');
            });
        }

        DB::table('company_metas')
            ->whereIn('meta_key', ['breadcrumb', 'support_email'])
            ->delete();
    }

    public function down(): void
    {
        if (!Schema::hasColumn('companies', 'footer_logo_image')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->string('footer_logo_image')->nullable()->after('logo');
            });
        }
    }
};
