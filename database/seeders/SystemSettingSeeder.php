<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       SystemSetting::create([
        'site_name' => 'Ecommerce Shop',
        "site_logo" => null,
        "site_favicon" => null,
        'site_phone' => 123456789,
        'site_email' => 'admin@gmail.com',
        "site_facebook_link" => 'ecom@facebook.com',
        "meta_keywords" => 'Vue, Laravel, React',
        "meta_description" => 'Its a Single vendor ecommerce shop'
    ]);
    }
}
