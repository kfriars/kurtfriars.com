<?php

namespace Tests\Feature;

use Tests\TestCase;

class DownloadCVTest extends TestCase
{
    /** @test */
    public function it_downloads_the_cv_using_a_valid_recaptcha_token()
    {
        $response = $this->get('cv/test-recaptcha-token');
        $response->assertStatus(200);
    }
}
