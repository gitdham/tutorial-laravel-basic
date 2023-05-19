<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigTest extends TestCase {
  public function testConfig() {
    $firstName = config('contoh.author.first');
    $lastName = config('contoh.author.last');
    $email = config('contoh.email');
    $web = config('contoh.web');

    self::assertEquals('Idham', $firstName);
    self::assertEquals('Doe', $lastName);
    self::assertEquals('adzani234@gmail.com', $email);
    self::assertEquals('github.com/gitdham', $web);
  }
}
