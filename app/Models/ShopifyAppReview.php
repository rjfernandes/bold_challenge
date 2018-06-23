<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopifyAppReview extends Model
{
    protected $fillable = [
          'shopify_domain'
        , 'app_slug'
        , 'star_rating'
        , 'previous_star_rating'
        , 'created_at'
    ];
}
