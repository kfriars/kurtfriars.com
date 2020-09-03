<?php

namespace Tests\Feature;

use Tests\TestCase;

class CVPageTest extends TestCase
{
    /** @test */
    public function it_loads_the_page()
    {
        $response = $this->get('/cv');
        $response->assertStatus(200);
    }
}
