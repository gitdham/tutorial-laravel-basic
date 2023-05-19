<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase {
    public function testGet() {
        $this->get('/hello')
            ->assertStatus(200)
            ->assertSeeText('Hello');
    }

    public function testRedirect() {
        $this->get('/world')
            ->assertRedirect('/hello');
    }

    public function testFallback() {
        $this->get('/noroute')
            ->assertSeeText('404');
    }

    public function testPage() {
        $this->get('/page')
            ->assertSeeText('Idham');
    }

    public function testChildPage() {
        $this->get('/child')
            ->assertStatus(200)
            ->assertSeeText('Roy');
    }

    public function testTemplate() {
        $this->view('hello', ['name' => 'Idham'])
            ->assertSeeText('Idham');
    }

    public function testRouteParameter() {
        $this->get('/products/1')
            ->assertStatus(200)
            ->assertSeeText('Product 1');

        $this->get('/products/2')
            ->assertStatus(200)
            ->assertSeeText('Product 2');

        $this->get('/products/1/items/2')
            ->assertStatus(200)
            ->assertSeeText('Product: 1, Item: 2');
    }

    public function testRouteRegexParameter() {
        $this->get('/products/1')
            ->assertStatus(200)
            ->assertSeeText('Product 1');

        $this->get('/products/salah')
            ->assertSeeText('404');
    }

    public function testOptionalParameter() {
        $this->get('/users/idham')
            ->assertStatus(200)
            ->assertSeeText('User: idham');

        $this->get('/users')
            ->assertStatus(200)
            ->assertSeeText('User: 404');
    }

    public function testNamedRoute() {
        $this->get('/produk/123')
            ->assertSeeText('Link http://localhost/products/123');
    }
}
