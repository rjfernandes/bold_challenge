<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DownloadAppTest extends TestCase
{
    /**
     * Download a store and check 
     * and expect success exists and be true
     *
     * @return void
     */
    public function testDownloadApp()
    {
        $response = $this->json('GET', '/download/store-reviews/store-locator');
        $data = $response->original;

        $this->assertTrue($response->getStatusCode() === 200 && array_key_exists('success', $data) && $data['success'] );
    }
}
