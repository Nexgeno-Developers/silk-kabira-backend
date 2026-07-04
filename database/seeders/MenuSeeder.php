<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuGroup;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed menu groups
        $menuGroups = [
            ['name' => 'Left Navigation', 'slug' => 'left-navigation', 'description' => 'left navigation menu', 'status' => true],
            ['name' => 'Right Navigation', 'slug' => 'right-navigation', 'description' => 'right navigation menu', 'status' => true],
            ['name' => 'Footer Explore', 'slug' => 'footer-explore', 'description' => 'Footer Explore menu', 'status' => true],
            ['name' => 'Footer Connect', 'slug' => 'footer-connect', 'description' => 'Footer Connect menu', 'status' => true],
            ['name' => 'Footer Terms', 'slug' => 'footer-terms', 'description' => 'Footer Terms menu', 'status' => true],
        ];

        foreach ($menuGroups as $groupData) {
            MenuGroup::firstOrCreate(
                ['slug' => $groupData['slug']],
                $groupData
            );
        }
    }
}
