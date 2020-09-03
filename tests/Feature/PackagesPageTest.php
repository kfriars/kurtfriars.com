<?php

namespace Tests\Feature;

use Tests\TestCase;

class PackagesPageTest extends TestCase
{
    /** @test */
    public function it_loads_the_page()
    {
        $response = $this->get('/packages');
        $response->assertStatus(200);
    }
}
