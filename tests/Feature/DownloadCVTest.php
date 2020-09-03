<?php

namespace Tests\Feature;

use Barryvdh\DomPDF\PDF;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemManager;
use Tests\TestCase;

class DownloadCVTest extends TestCase
{
    /** @test */
    public function it_downloads_the_cv_using_a_valid_recaptcha_token()
    {
        /** @var Filesystem */
        $filesystem = $this->app->make(FilesystemManager::class)->createLocalDriver([ 'root' => storage_path() ]);

        // Handle CI where the file won't exist
        if (! $filesystem->exists('private/Kurt Friars - Resume.pdf')) {
            $this->app->make(PDF::class)->loadHTML('<h1>Test Resume</h1>')
                ->setPaper('a4')
                ->setWarnings(false)
                ->save(storage_path("private/'Kurt Friars - Resume.pdf'"));
        }

        $response = $this->get('cv/test-recaptcha-token');
        $response->assertStatus(200);
    }
}
