<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $year = env('PARTI_ACTIVE_YEAR', 2026);

        Sponsor::updateOrCreate(
            ['year' => $year, 'name' => 'Vanguard Technology'],
            [
                'logo_path' => 'sponsors/placeholder-platinum.png',
                'website_url' => 'https://example.com',
                'tier' => 'PLATINUM',
                'order' => 1,
                'is_active' => true,
            ]
        );

        Sponsor::updateOrCreate(
            ['year' => $year, 'name' => 'Muhammadiyah Developer Community'],
            [
                'logo_path' => 'sponsors/placeholder-gold.png',
                'website_url' => 'https://example.com',
                'tier' => 'GOLD',
                'order' => 2,
                'is_active' => true,
            ]
        );

        Sponsor::updateOrCreate(
            ['year' => $year, 'name' => 'Solo Creative Hub'],
            [
                'logo_path' => 'sponsors/placeholder-silver.png',
                'website_url' => 'https://example.com',
                'tier' => 'SILVER',
                'order' => 3,
                'is_active' => true,
            ]
        );
    }
}
