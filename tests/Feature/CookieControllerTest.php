<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase {
    public function testCreateCookie() {
        $this->get('/cookie/set')
            ->assertSeeText('Hello Cookie')
            ->assertCookie('User-Id', 'idham')
            ->assertCookie('Is-Member', 'true');
    }

    public function testGetCookie() {
        $cookies = [
            'User-Id' => 'idham',
            'Is-Member' => 'true'
        ];

        $this->withCookies($cookies)
            ->get('/cookie/get')
            ->assertJson([
                'userId' => 'idham',
                'isMember' => 'true'
            ]);
    }

    public function testGetGuestCookie() {
        $this->get('/cookie/get')
            ->assertJson([
                'userId' => 'guest',
                'isMember' => 'false'
            ]);
    }
}
