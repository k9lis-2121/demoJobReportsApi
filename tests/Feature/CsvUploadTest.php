<?php

namespace Tests\Unit;

use App\Models\Worker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CsvUploadTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test file upload and workers creation.
     *
     * @test
     * @return void
     */
    public function it_can_upload_csv_file_and_create_workers()
    {
        Storage::fake('csv');

        $file = UploadedFile::fake()->createWithContent(
            'test.csv',
            "name,age\nJohn,30\nJane,25"
        );

        $response = $this->post('/workers/upload', [
            'csv_file' => $file,
        ]);
        $response->assertStatus(302);
        //TODO Дописать тест. Пока не понимаю как правильно проверить загрузку фалов
    }
}
