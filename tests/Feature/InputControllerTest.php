<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase {
    public function testInput() {
        $this->get('/input/hello?name=Idham')
            ->assertSeeText('Hello Idham');

        $this->post('/input/hello', ['name' => 'Idham'])
            ->assertSeeText('Hello Idham');
    }

    public function testNestedInput() {
        $this->post('/input/hello/first', ['name' => ['first' => 'Idham', 'last' => 'Adzani']])
            ->assertSeeText('Hello Idham Adzani');
    }

    public function testGetAllInput() {
        $data = [
            'name' => ['first' => 'Idham', 'last' => 'Adzani'],
            'age' => 28,
            'sex' => 'Male',
        ];

        $this->post('/input/hello/input', $data)
            ->assertSeeText('name')
            ->assertSeeText('first')->assertSeeText('Idham')
            ->assertSeeText('last')->assertSeeText('Adzani')
            ->assertSeeText('age')->assertSeeText('28')
            ->assertSeeText('sex')->assertSeeText('Male');

        $this->get('/input/hello/input?name=Idham&age=28&sex=Male')
            ->assertSeeText('name')->assertSeeText('Idham')
            ->assertSeeText('age')->assertSeeText('28')
            ->assertSeeText('sex')->assertSeeText('Male');
    }

    public function testArrayInput() {
        $data = [
            'products' => [
                [
                    'name' => 'Apple Mac Book Pro',
                    'price' => '5999999'
                ],
                [
                    'name' => 'Samsung Galaxy S',
                    'price' => '2599999'
                ],
            ]
        ];

        $this->post('/input/hello/array', $data)
            ->assertSeeText('Apple Mac Book Pro')
            ->assertSeeText('Samsung Galaxy S');
    }

    public function testInputType() {
        $data = [
            'name' => 'Budi',
            'married' => 'true',
            'birth_date' => '1994-03-23'
        ];

        $this->post('/input/type', $data)
            ->assertSeeText('Budi')
            ->assertSeeText('true')
            ->assertSeeText('1994-03-23');
    }

    public function testFilterOnly() {
        $data = [
            'name' => [
                'first' => 'Idham',
                'middle' => 'Nur',
                'last' => 'Adzani'
            ]
        ];

        $this->post('/input/filter/only', $data)
            ->assertSeeText('Idham')
            ->assertSeeText('Adzani')
            ->assertDontSeeText('Nur');
    }

    public function testFilterExcept() {
        $data = [
            'name' => [
                'first' => 'Idham',
                'middle' => 'Nur',
                'last' => 'Adzani'
            ],
            'admin' => 'true',
        ];

        $this->post('/input/filter/only', $data)
            ->assertSeeText('Idham')
            ->assertSeeText('Adzani')
            ->assertDontSeeText('admin');
    }

    public function testFilterMerge() {
        $data = [
            'username' => 'idham',
            'admin' => 'true',
            'password' => '123'
        ];

        $this->post('/input/filter/merge', $data)
            ->assertSeeText('idham')
            ->assertSeeText('123')
            ->assertSeeText('admin')
            ->assertSeeText('false');
    }
}
