<?php

use Illuminate\Database\Seeder;
use App\Models\Appslug;

class SlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $appSlugs = collect([
              'product-upsell'
            , 'product-discount'
            , 'store-locator'
            , 'product-options'
            , 'quantity-breaks'
            , 'product-bundles'
            , 'customer-pricing'
            , 'product-builder'
            , 'social-triggers'
            , 'recurring-orders'
            , 'multi-currency'
            , 'quickbooks-online'
            , 'xero'
            , 'the-bold-brain'
        ]);

        $appSlugs->each(function($appSlug) {
            Appslug::updateOrCreate(['app_slug' => $appSlug]);
        });
    }
}
