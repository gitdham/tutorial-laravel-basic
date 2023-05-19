<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvTest extends TestCase {
  public function testGetEnv() {
    $firstName = env('FIRST_NAME');
    $lastName = env('LAST_NAME', 'Adzani');

    self::assertEquals('Idham', $firstName);
    self::assertEquals('Adzani', $lastName);
  }
}
