<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

/**
 * Seeder Data Sponsor
 *
 * Mengisi database dengan 100 sampel data sponsor realistis dari sektor teknologi, enterprise, hingga komunitas.
 * Digunakan untuk menguji performa dan tampilan visual marquee animasi dua baris pada beranda publik PARTI 2026.
 */
class SponsorSeeder extends Seeder
{
    /**
     * Jalankan penanaman data sponsor ke database.
     *
     * Membuat data sponsor dan menggenerasi logo SVG otomatis untuk tier Platinum, Gold, dan Silver.
     */
    public function run(): void
    {
        $year = env('PARTI_ACTIVE_YEAR', 2026);

        Schema::disableForeignKeyConstraints();
        Sponsor::truncate();
        Schema::enableForeignKeyConstraints();

        $sponsorsData = [
            // PLATINUM TIERS (10 Sponsor Utama dengan Tautan Aktif)
            ['name' => 'Google Cloud Indonesia', 'tier' => Sponsor::TIER_PLATINUM, 'url' => 'https://cloud.google.com'],
            ['name' => 'Microsoft Indonesia', 'tier' => Sponsor::TIER_PLATINUM, 'url' => 'https://microsoft.com/id-id'],
            ['name' => 'Amazon Web Services', 'tier' => Sponsor::TIER_PLATINUM, 'url' => 'https://aws.amazon.com'],
            ['name' => 'Tokopedia Tech', 'tier' => Sponsor::TIER_PLATINUM, 'url' => 'https://www.tokopedia.com'],
            ['name' => 'Gojek Financial & Tech', 'tier' => Sponsor::TIER_PLATINUM, 'url' => 'https://www.gojek.com'],
            ['name' => 'Shopee International', 'tier' => Sponsor::TIER_PLATINUM, 'url' => 'https://shopee.co.id'],
            ['name' => 'Traveloka Technology', 'tier' => Sponsor::TIER_PLATINUM, 'url' => 'https://www.traveloka.com'],
            ['name' => 'Bank Central Asia (BCA Digital)', 'tier' => Sponsor::TIER_PLATINUM, 'url' => 'https://www.bca.co.id'],
            ['name' => 'Telkomsel Enterprise', 'tier' => Sponsor::TIER_PLATINUM, 'url' => 'https://www.telkomsel.com'],
            ['name' => 'Indosat Ooredoo Hutchison', 'tier' => Sponsor::TIER_PLATINUM, 'url' => 'https://ioh.co.id'],

            // GOLD TIERS (30 Sponsor Gold)
            ['name' => 'Dicoding Indonesia', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://www.dicoding.com'],
            ['name' => 'Niagahoster Web Hosting', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://www.niagahoster.co.id'],
            ['name' => 'Ruangguru Academy', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://www.ruangguru.com'],
            ['name' => 'Bukalapak Engineering', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://www.bukalapak.com'],
            ['name' => 'Blibli Digital', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://www.blibli.com'],
            ['name' => 'DANA Indonesia', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://dana.id'],
            ['name' => 'OVO Payment', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://www.ovo.id'],
            ['name' => 'LinkAja Fintech', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://www.linkaja.id'],
            ['name' => 'Tiket.com Tech', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://www.tiket.com'],
            ['name' => 'Halodoc Healthtech', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://www.halodoc.com'],
            ['name' => 'Bibit Investasi Digital', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://bibit.id'],
            ['name' => 'Stockbit Financial', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://stockbit.com'],
            ['name' => 'Pluang Wealth', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://pluang.com'],
            ['name' => 'Midtrans Payment Gateway', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://midtrans.com'],
            ['name' => 'Xendit Financial Infrastructure', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://www.xendit.co'],
            ['name' => 'Privy Digital Signature', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://privy.id'],
            ['name' => 'Sirclo E-Commerce Solution', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://www.sirclo.com'],
            ['name' => 'Fastwork Freelance Platform', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://fastwork.id'],
            ['name' => 'Kahf Men Care', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://www.kahfcared.com'],
            ['name' => 'Wardah Beauty Tech', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://www.wardahbeauty.com'],
            ['name' => 'Paragon Technology & Innovation', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://www.paragon-innovation.com'],
            ['name' => 'Smartfren Telecom', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://www.smartfren.com'],
            ['name' => 'XL Axiata Business Solutions', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://www.xl.co.id'],
            ['name' => 'Biznet Networks', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://www.biznetnetworks.com'],
            ['name' => 'Telkom Indonesia', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://www.telkom.co.id'],
            ['name' => 'Astro Quick Commerce', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://www.tokoadai.com'],
            ['name' => 'Kopi Kenangan Tech', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://kopikenangan.com'],
            ['name' => 'Janji Jiwa Group', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://jiwagroup.com'],
            ['name' => 'Somethinc Beauty', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://somethinc.com'],
            ['name' => 'Erigo Apparel Tech', 'tier' => Sponsor::TIER_GOLD, 'url' => 'https://erigostore.co.id'],

            // SILVER TIERS (30 Sponsor Silver)
            ['name' => 'Solo Technopark', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://solotechnopark.id'],
            ['name' => 'Jogja Digital Valley', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://jogjadigitalvalley.com'],
            ['name' => 'Bandung Digital Valley', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://bandungdigitalvalley.com'],
            ['name' => 'Makassar Digital Valley', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://makassardigitalvalley.com'],
            ['name' => 'Agate Games Studio', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://agate.id'],
            ['name' => 'Touchten Games', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://www.touchten.com'],
            ['name' => 'Evos Esports Technology', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://evos.gg'],
            ['name' => 'RRQ Esports', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://teamrrq.com'],
            ['name' => 'ONIC Esports', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://onic-esports.com'],
            ['name' => 'Alter Ego Esports', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://alterego.id'],
            ['name' => 'Bigetron Esports', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://bigetron.gg'],
            ['name' => 'Boom Esports', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://boomesports.gg'],
            ['name' => 'Dewa United Tech', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://dewaunited.com'],
            ['name' => 'Genesis Dogma', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://genesisdogma.com'],
            ['name' => 'Morph Team', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://morphteam.id'],
            ['name' => 'Dewaweb Cloud Hosting', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://www.dewaweb.com'],
            ['name' => 'DomaiNesia Domain & Hosting', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://www.domainesia.com'],
            ['name' => 'Rumahweb Indonesia', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://www.rumahweb.com'],
            ['name' => 'Qwords Cloud Web Hosting', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://qwords.com'],
            ['name' => 'IDcloudhost Cloud Provider', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://idcloudhost.com'],
            ['name' => 'Exabytes Indonesia', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://www.exabytes.co.id'],
            ['name' => 'Jagoan Hosting', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://www.jagoanhosting.com'],
            ['name' => 'Hostinger Indonesia', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://www.hostinger.co.id'],
            ['name' => 'Sanukri Cloud', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://example.com'],
            ['name' => 'Codepolitan Learning', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://www.codepolitan.com'],
            ['name' => 'BuildWithAngga', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://buildwithangga.com'],
            ['name' => 'Sanbercode Academy', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://sanbercode.com'],
            ['name' => 'Altera Academy', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://altera.id'],
            ['name' => 'Hacktiv8 Bootcamp', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://hacktiv8.com'],
            ['name' => 'Binar Academy', 'tier' => Sponsor::TIER_SILVER, 'url' => 'https://binaracademy.com'],

            // BRONZE TIERS (30 Sponsor Bronze / Media & Community Partners)
            ['name' => 'Solo Code Community', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'Jogja Dev Community', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'Semarang JS Community', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'Surabaya Dev Circle', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'Malang Dev Collective', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'Bandung JS Community', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'Jakarta JS User Group', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'Bali JS Tech', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'Medan Dev Community', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'Makassar Dev Hub', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'GDG Solo (Google Developer Group)', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'WTM Solo (Women Techmakers)', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'Python Solo Community', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'PHP Indonesia Surakarta', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'Laravel Surakarta User Group', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'Flutter Solo Community', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'React Indonesia Chapter Solo', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'Cyber Security Solo Community', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'DevOps Solo Chapter', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'UI/UX Solo Creative Network', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'BEM FKI UMS', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'DPM FKI UMS', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'UKM Robotik UMS', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'UKM Taekwondo UMS', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'Persma Varia UMS', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'Radio Rapma UMS', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'KSEI UMS', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'Open Source Indonesia', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'Nusantara Code Network', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
            ['name' => 'Indonesia Tech Network', 'tier' => Sponsor::TIER_BRONZE, 'url' => 'https://example.com'],
        ];

        foreach ($sponsorsData as $index => $item) {
            $logoFileName = null;

            // Berkas SVG gambar disiapkan hanya untuk tier Platinum, Gold, dan Silver.
            // Tier Bronze disajikan secara minimalis sebagai teks/badge nama.
            if (in_array($item['tier'], [Sponsor::TIER_PLATINUM, Sponsor::TIER_GOLD, Sponsor::TIER_SILVER])) {
                $logoFileName = 'sponsors/logo-' . ($index + 1) . '.svg';
                $svgContent = $this->generateSvgLogo($item['name'], $item['tier'], $index + 1);
                Storage::disk('public')->put($logoFileName, $svgContent);
            }

            Sponsor::create([
                'year' => $year,
                'name' => $item['name'],
                'logo_path' => $logoFileName ?? '',
                'website_url' => $item['url'],
                'tier' => $item['tier'],
                'order' => $index + 1,
                'is_active' => true,
            ]);
        }
    }

    /**
     * Menggenerasi berkas logo SVG bergradasi secara otomatis sesuai inisial nama dan tier sponsor.
     *
     * Penggenerasian logo internal ini menjamin ketersediaan sampel gambar visual tanpa bergantung pada berkas eksternal.
     */
    private function generateSvgLogo(string $name, string $tier, int $index): string
    {
        $palettes = [
            Sponsor::TIER_PLATINUM => ['#F5C842', '#FF851B', '#121215', '#FFFFFF'],
            Sponsor::TIER_GOLD => ['#DDA821', '#C87D20', '#1A1815', '#F5C842'],
            Sponsor::TIER_SILVER => ['#94A3B8', '#64748B', '#0F172A', '#E2E8F0'],
            Sponsor::TIER_BRONZE => ['#CD7F32', '#A0522D', '#1C1917', '#F59E0B'],
        ];

        $scheme = $palettes[$tier] ?? $palettes[Sponsor::TIER_SILVER];
        $c1 = $scheme[0];
        $c2 = $scheme[1];
        $cText = $scheme[3];

        $words = explode(' ', $name);
        $initials = '';
        foreach ($words as $w) {
            $initials .= strtoupper(substr($w, 0, 1));
            if (strlen($initials) >= 3) break;
        }
        if (empty($initials)) $initials = 'SP';

        $escapedName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 220 50" width="220" height="50">
  <defs>
    <linearGradient id="grad-{$index}" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="{$c1}" />
      <stop offset="100%" stop-color="{$c2}" />
    </linearGradient>
  </defs>
  <rect x="2" y="2" width="46" height="46" rx="12" fill="url(#grad-{$index})" />
  <text x="25" y="31" font-family="'Space Grotesk', system-ui, sans-serif" font-size="16" font-weight="800" fill="#000000" text-anchor="middle">{$initials}</text>
  <text x="60" y="30" font-family="'Plus Jakarta Sans', system-ui, sans-serif" font-size="13" font-weight="700" fill="{$cText}">{$escapedName}</text>
</svg>
SVG;
    }
}

