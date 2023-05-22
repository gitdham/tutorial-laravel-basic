<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase {
    public function testResponse() {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText('Hello response');
    }

    public function testHeader() {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertSeeText('Idham')->assertSeeText('Adzani')
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Author', 'Skynet')
            ->assertHeader('App', 'Terminator 3');
    }

    public function testView() {
        $this->get('/response/type/view')
            ->assertSeeText('Hello Idham');
    }

    public function testJson() {
        $this->get('/response/type/json')
            ->assertJson([
                'firstName' => 'Idham',
                'lastName' => 'Adzani'
            ]);
    }

    public function testFile() {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', 'image/png');
    }

    public function testDownload() {
        $this->get('/response/type/download')
            ->assertDownload('logo-sentry.png');
    }
}
