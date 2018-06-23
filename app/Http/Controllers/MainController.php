<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopifyAppReview;

class MainController extends Controller
{
    public function index() {
        return view('index');
    }

    public function jsPage() {
        $slugs = ShopifyAppReview
                    ::get(['app_slug'])
                    ->pluck('app_slug')
                    ->unique()
                    ->sort()
                    ->flatten()
                ;

        $firstSlug = $slugs->first();

        return view('index_js')
                        ->with([
                                'slugs' => $slugs,
                                'currentSlug' => $firstSlug,
                                'reviews' => $this->reviews($firstSlug)
                        ]);
    }

    public function reviews($slug) {
        return ShopifyAppReview
                    ::whereAppSlug($slug)
                    ->get([
                        'shopify_domain',
                        'star_rating',
                        'previous_star_rating',
                        'created_at'
                    ]);
    }

}
