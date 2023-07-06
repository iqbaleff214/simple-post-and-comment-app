<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    public function test_landing_page_displayed(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSeeText("Register");
        $response->assertSeeText("Log in");
    }
}
