<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContohMiddlewareTest extends TestCase {
    public function testMiddlewareInvalid() {
        $this->get('/middleware/api')
            ->assertStatus(401)
            ->assertSeeText('Access Denied');
    }

    public function testMiddlewareValid() {
        $this->withHeader('X-API-KEY', 'XXX')
            ->get('/middleware/api')
            ->assertStatus(200)
            ->assertSeeText('OK');
    }
}
