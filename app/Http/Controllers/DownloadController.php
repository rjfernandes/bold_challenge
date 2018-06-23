<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AppSlug;
use App\Models\Config;
use App\Models\ShopifyAppReview;
use Carbon\Carbon;

class DownloadController extends Controller
{

    public function index() {
        return view('download');
    }

    public function storeReviews($slug) {
        $items = $this->getReviewsFromSlug($slug);
        if (is_string($items)) {
            return response()->json(['success' => false, 'error' => $items], 500);
        }
        else if ($items->count() > 0) {
            $this->store($slug, $items);
        }

        return ['success' => true, 'reviewsDownloaded' => $items->count()];
    }

    private function getReviewsFromSlug($slug) {
        try {
            $url = sprintf('https://apps.shopify.com/%s/reviews.json', $slug);
            $data = file_get_contents($url);

            return collect(json_decode($data, true)['reviews'])
                        ->map(function($item) use($slug) {
                            return [
                                'shopify_domain' => $item['shop_domain']
                              , 'app_slug' => $slug
                              , 'star_rating' => $item['star_rating']
                              , 'created_at' => new Carbon($item['created_at'])
                          ];
                        });
        }
        catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    private function store($slug, $reviews) {
        $lastUpdates = ShopifyAppReview::whereAppSlug($slug)->get(['shopify_domain', 'star_rating', 'created_at']);
        $reviews->each(function($review) use($lastUpdates) {
            $find = $review;
            unset($find['star_rating']);

            /**
             * Check if has a different star rating
             */
            $lastReviewUpdate = $lastUpdates->where('shopify_domain', $review['shopify_domain'])->first();
            if (!is_null($lastReviewUpdate) && $lastReviewUpdate->star_rating != $review['star_rating']) {
                $review['previous_star_rating'] = $lastReviewUpdate->star_rating;  
            }

            ShopifyAppReview::updateOrCreate($find, $review);
        });
    }

    public function jsPage() {
        $intervalTime = optional(Config::first())->interval_time;
        return view('download_js')
                    ->with([
                            'slugs' => AppSlug::get(['app_slug'])->pluck('app_slug'),
                            'intervalTime' => is_null($intervalTime) ? 60 : $intervalTime
                        ]
                );
    }

    public function configureTime(Request $request) {
        $config = Config::first();
        $config->interval_time = $request->input('minutes', 60);
        $config->save();
        return ['success' => true];
    }

}
