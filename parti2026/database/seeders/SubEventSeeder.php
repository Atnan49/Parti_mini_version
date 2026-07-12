<?php

namespace Database\Seeders;

use App\Models\SubEvent;
use App\Models\TimelineItem;
use Illuminate\Database\Seeder;

class SubEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $year = env('PARTI_ACTIVE_YEAR', 2026);

        // 1. Seed Sub Events
        $webinar = SubEvent::updateOrCreate(
            ['slug' => 'webinar-nasional'],
            [
                'year' => $year,
                'name' => 'Webinar Nasional',
                'tagline' => 'Pembuka Rangkaian',
                'description' => 'Mengusung track record kuat dari penyelenggaraan sebelumnya, dijadwalkan di awal agar hasilnya turut mendukung sub acara berikutnya.',
                'date_start' => '2026-10-03',
                'date_end' => '2026-10-03',
                'pj_names' => ['Rizqi', 'Tasya'],
                'htm_tiers' => [
                    ['label' => 'Reguler (Umum)', 'price' => 0]
                ],
                'status' => 'PUBLISHED',
                'order' => 1,
            ]
        );

        $webprog = SubEvent::updateOrCreate(
            ['slug' => 'lomba-web-programming'],
            [
                'year' => $year,
                'name' => 'Lomba Web Programming',
                'tagline' => 'Penunjang Produktivitas',
                'description' => 'Kompetisi dengan basis peminat luas, terbuka untuk pelajar SMA/SMK hingga mahasiswa umum se-Solo Raya dan sekitarnya.',
                'date_start' => '2026-10-10',
                'date_end' => '2026-10-11',
                'pj_names' => ['Atnan', 'Anes'],
                'htm_tiers' => [
                    ['label' => 'Umum', 'price' => 35000]
                ],
                'status' => 'PUBLISHED',
                'order' => 2,
            ]
        );

        $futsal = SubEvent::updateOrCreate(
            ['slug' => 'lomba-futsal'],
            [
                'year' => $year,
                'name' => 'Lomba Futsal',
                'tagline' => 'Puncak Antusiasme',
                'description' => 'Konsisten digelar dua tahun terakhir dengan animo tinggi, khususnya dari kalangan pelajar SMA/SMK se-Solo Raya.',
                'date_start' => '2026-10-17',
                'date_end' => '2026-10-18',
                'pj_names' => ['Patra', 'Ega'],
                'htm_tiers' => [
                    ['label' => 'HTM Per Tim', 'price' => 150000]
                ],
                'status' => 'PUBLISHED',
                'order' => 3,
            ]
        );

        $baksos = SubEvent::updateOrCreate(
            ['slug' => 'bakti-sosial'],
            [
                'year' => $year,
                'name' => 'Bakti Sosial',
                'tagline' => 'Penutup Rangkaian',
                'description' => 'Menyalurkan donasi yang terkumpul sepanjang rangkaian PARTI kepada panti asuhan, panti jompo, dan yayasan yang membutuhkan.',
                'date_start' => '2026-10-24',
                'date_end' => '2026-10-24',
                'pj_names' => ['Usva', 'Holiza'],
                'htm_tiers' => [
                    ['label' => 'Donasi Sukarela', 'price' => 0]
                ],
                'status' => 'PUBLISHED',
                'order' => 4,
            ]
        );

        // 2. Seed Timeline Items
        TimelineItem::updateOrCreate(
            ['year' => $year, 'title' => 'Webinar Nasional'],
            [
                'sub_event_id' => $webinar->id,
                'date' => '2026-10-03',
                'description' => 'Membuka rangkaian, mendukung pendanaan sub acara berikutnya.',
                'order' => 1,
            ]
        );

        TimelineItem::updateOrCreate(
            ['year' => $year, 'title' => 'Web Programming'],
            [
                'sub_event_id' => $webprog->id,
                'date' => '2026-10-10',
                'description' => 'Waktu persiapan matang di minggu kedua penyelenggaraan.',
                'order' => 2,
            ]
        );

        TimelineItem::updateOrCreate(
            ['year' => $year, 'title' => 'Lomba Futsal'],
            [
                'sub_event_id' => $futsal->id,
                'date' => '2026-10-17',
                'description' => 'Titik tengah dengan animo dan dukungan dana tertinggi.',
                'order' => 3,
            ]
        );

        TimelineItem::updateOrCreate(
            ['year' => $year, 'title' => 'Bakti Sosial'],
            [
                'sub_event_id' => $baksos->id,
                'date' => '2026-10-24',
                'description' => 'Penutup rangkaian, penyerahan donasi kepada yang membutuhkan.',
                'order' => 4,
            ]
        );
    }
}
