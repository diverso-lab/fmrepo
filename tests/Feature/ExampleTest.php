<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function testBasicTest()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('home'));

        $response->assertStatus(200);
    }
}
