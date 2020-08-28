<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Setting::create([
        //     'key' => 'my name',
        //     'is_translatable' => 0,
        //     'plain_value' => 'Aamer Dirar'
        // ]);
        Setting::setMany([
            'default_locale' => 'ar',
            'default_timezone' => 'Africa/Cairo',
            'reviewes_enabled' => true,
            'auto_approve_reviews' => true,
            'supported_currencies' => ['USD', 'LE', 'SAR', 'SDG'],
            'default_currency' => 'USD',
            'store_email' => 'sales@aid.com',
            'search_engine' => 'mysql',
            'local_shipping_cost' => 0,
            'outer_shipping_cost' => 0,
            'free_shipping_cost' => 0,
            'translatable' => [
                'store_name' => 'AID Store',
                'free_shipping_label' => 'Free Shipping',
                'local_label' => 'Local Shipping',
                'outer_label' => 'Outer Shipping',
            ],
        ]);
    }
}
