<?php

namespace Tests\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;


use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }

    /*public function test_destroyById_book_return_status () {
        $response = $this->delete('/api/books/48');
        $response->assertEquals(204 , $response->getStatusCode());
    }*/


}
