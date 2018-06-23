<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainTest extends TestCase
{
    /**
     * InitialPage 
     * Find AngularJS ReviewController word on content body
     * @return void
     */
    public function testInitialPage() 
    {
        $response = $this->json('GET', '/app.js');
        $page = $response->getContent();

        $this->assertTrue($response->getStatusCode() === 200 && strpos($page, 'ReviewController') !== false );
    }

    /**
     * ReviewForApp 
     * Get an json array with reviews from an app
     *
     * @return void
     */
    public function testReviewForApp() 
    {
        $response = $this->json('GET', '/reviews/product-builder');
        $data = $response->original;
        $this->assertTrue($response->getStatusCode() === 200 && !is_null(optional($data)->count()) );
    }
}
