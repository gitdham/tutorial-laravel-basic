<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase {
    public function testUrlCurrent() {
        $this->get('/url/current?name=Idham')
            ->assertSeeText('/url/current?name=Idham');
    }
}
