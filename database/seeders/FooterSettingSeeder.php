<?php

namespace Database\Seeders;

use App\Models\FooterSetting;
use Illuminate\Database\Seeder;

class FooterSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FooterSetting::firstOrCreate(
            [], // if it exists, don't create
            [
                'company_name' => 'Sama CV',
                'company_description' => 'Créez des CVs professionnels qui font la différence.',
                'footer_text' => 'Créez des CVs professionnels qui font la différence. Gratuit, simple et efficace.',
                'linkedin_url' => 'https://linkedin.com',
                'twitter_url' => 'https://twitter.com',
                'github_url' => 'https://github.com',
                'contact_email' => 'contact@samacv.com',
                'contact_phone' => '+33 1 23 45 67 89',
            ]
        );
    }
}
