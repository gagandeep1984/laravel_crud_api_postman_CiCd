<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * 1. Importing Database migraitons - testing is performed after Migrations is done successfully.. 
 * 2. 
 */
class PostTest extends TestCase
{
    // use DatabaseMigrations;
    // use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /* @test */
    // public function test_fetch_students()
    // {
    //     $response = $this->get("/api/students");
    //     $response->assertStatus(404); // )->assert(count($response) != 0);
    // }
}
