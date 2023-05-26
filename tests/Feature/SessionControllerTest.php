<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase {
    public function testCreateSession() {
        $this->get('/session/create')
            ->assertSeeText('OK')
            ->assertSessionHas('userId', 'adzani')
            ->assertSessionHas('isMember', 'true');
    }

    public function testGetSession() {
        $session = [
            'userId' => 'adzani',
            'isMember' => 'true'
        ];

        $this->withSession($session)->get('/session/get')
            ->assertSeeText('adzani')
            ->assertSeeText('true');
    }

    public function testGetEmptySession() {
        $this->withSession([])->get('/session/get')
            ->assertSeeText('guest')
            ->assertSeeText('false');
    }
}
