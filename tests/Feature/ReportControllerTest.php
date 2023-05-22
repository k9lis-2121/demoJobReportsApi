<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReportControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testIndexMethod()
    {
        $response = $this->get('/reports');
        $response->assertStatus(200);
        $response = $this->get('/reports?week=2');
        $response->assertStatus(200);
    }

    public function testShowMethod()
    {
        $response = $this->get('/reports/1?week=1');
        $response->assertStatus(200);
    }



}
