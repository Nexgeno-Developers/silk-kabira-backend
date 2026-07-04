<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed a single company with professional dummy data
        $company = Company::firstOrCreate(
            ['email' => 'info@example.com'],
            [
                'name' => '{Company}',
                'phone' => '02134567890',
                'whatsapp' => '919876543210',
                'address' => 'Head Office, Mumbai, India',
                'website' => 'https://example.com',
                'google_map' => '',
                'copyright_text' => 'Copyright 2026 Example. All rights reserved.',
                'catalogue' => null,
                'sample' => null,
                'cta_title' => 'Start your next project with us',
                'cta_subtitle' => 'Speak with our team for tailored solutions and quick support.',
                'is_active' => 1,
            ],
        );

    }
}
