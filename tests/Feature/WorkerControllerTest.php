<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class WorkerControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testIndexMethod()
    {
        $response = $this->get('/workers');
        $response->assertStatus(200);
    }


}
