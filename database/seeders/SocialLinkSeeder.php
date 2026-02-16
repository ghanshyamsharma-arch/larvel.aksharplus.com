<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Seeder;

// Add in DatabaseSeeder: $this->call(SocialLinkSeeder::class);

class SocialLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            ['platform' => 'x',         'label' => 'Twitter / X',  'url' => 'https://x.com/aksharplus',         'sort_order' => 1],
            ['platform' => 'linkedin',   'label' => 'LinkedIn',     'url' => 'https://linkedin.com/company/aksharplus', 'sort_order' => 2],
            ['platform' => 'instagram',  'label' => 'Instagram',    'url' => 'https://instagram.com/aksharplus', 'sort_order' => 3],
            ['platform' => 'youtube',    'label' => 'YouTube',      'url' => 'https://youtube.com/@aksharplus',  'sort_order' => 4],
        ];

        foreach ($links as $link) {
            SocialLink::firstOrCreate(
                ['platform' => $link['platform']],
                array_merge($link, ['is_active' => true])
            );
        }

        $this->command->info('✅ Social links seeded!');
    }
}
