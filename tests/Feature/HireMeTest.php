<?php

namespace Tests\Feature;

use App\Domain\Prospect\Mail\NewProspect;
use App\Domain\Prospect\Models\Prospect;
use Tests\TestCase;
use Tests\Traits\MailHogTrait;

class HireMeTest extends TestCase
{
    use MailHogTrait;

    /** @test */
    public function it_sends_an_email_when_the_hire_me_form_is_filled_out_correctly()
    {
        $this->setupMailTest();

        $response = $this->postJson(route('prospect.store'), [
            'email' => 'great@prospects.com',
            'message' => 'We would love to hire you, please reach out to us!',
            'recaptcha_token' => 'doesnt-matter-for-testing',
        ]);

        $response->assertStatus(201);

        $prospect = Prospect::first();
        $this->assertEquals('great@prospects.com', $prospect->email);
        $this->assertEquals('We would love to hire you, please reach out to us!', $prospect->message);

        $this->assertMailableSentTo('kfriars@gmail.com', new NewProspect($prospect));
    }

    /** @test */
    public function hire_me_form_422()
    {
        $response = $this->postJson(route('prospect.store'), [
            'email' => '',
        ]);
        $response->assertStatus(422);
        
        $response = $this->postJson(route('prospect.store'), [
            'email' => 'bad_email',
        ]);
        $response->assertStatus(422);

        $response = $this->postJson(route('prospect.store'), [
            'email' => 3232423424,
        ]);
        $response->assertStatus(422);
    }
}
