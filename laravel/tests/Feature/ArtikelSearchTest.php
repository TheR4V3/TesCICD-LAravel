<?php

namespace Tests\Feature;

use App\Models\artikel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArtikelSearchTest extends TestCase
{
    use RefreshDatabase; 

    /** @test */
    public function SearchJudul()
    {
        artikel::create([
            'Judul' => 'Testing',
            'Deskripsi' => 'contoh deskripsi.',
            'Image' => 'sample_image.jpg',
            'Created_by' => 'test_user',
        ]);

        $response = $this->get('/artikel/search?query=Test');


        $response->assertStatus(200);
        $response->assertSee('Testing'); 
        $response->assertDontSee('Nope gak ada.'); 
    }

    /** @test */
    public function JudulTidakAda()
    {
        $response = $this->get('/artikel/search?query=bpjz123');
        $response->assertStatus(200);
        $response->assertSee('Hasil tidak ditemukan.'); 
    }

    /** @test */
    public function TampilkanAll()
    {
        artikel::create(['Judul' => 'Artikel 1', 'Deskripsi' => 'Deskripsi Artikel 1.', 'Image' => 'image1.jpg', 'Created_by' => 'user1']);
        artikel::create(['Judul' => 'Artikel 2', 'Deskripsi' => 'Deskripsi Artikel 2.', 'Image' => 'image2.jpg', 'Created_by' => 'user2']);

        $response = $this->get('/artikel/search?query=');

        $response->assertStatus(200);
        $response->assertSee('Artikel 1');
        $response->assertSee('Artikel 2');
    }
}
