<?php

namespace Tests\Feature;

use App\Models\Manager;
use App\Models\Supermarket;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class supermarketTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_supermarket_run()
    {
        $response = $this->get('/home');
        $response->assertStatus(302);
        $response = $this->followRedirects($response);
        $response->assertStatus(200);
    }
    public function testCreateSupermarket()
    {
        $response = $this->post('/supermarket/create', [
            'name' => 'Test Supermarket',
            'locationid' => 'Test Location',
        ]);

        $response->assertStatus(302);
        $response = $this->followRedirects($response);
        $response->assertStatus(200);

    }



    public function testUpdateSupermarket()
    {
        $supermarket = Supermarket::factory()->create();
        $response = $this->put('/supermarket/edit/'.$supermarket->id, [
            'name' => 'Updated Supermarket',
            'locationid' => 'Updated Location',
        ]);
        $this->assertDatabaseHas('supermarkets', [
            'id' => $supermarket->id,
            'name' => 'Updated Supermarket',
            'location' => 'Updated Location',
        ]);
        $response->assertRedirect('/home');
        $response->assertSessionHas('mssg', 'update successfully');
    }
    public function testDeleteSupermarket()
    {
        $supermarket = Supermarket::factory()->create();
        $response = $this->delete('/home/'.$supermarket->id);
        $response->assertStatus(302);
        $response = $this->get($response->headers->get('Location'));
        $response->assertStatus(200);


    }


    public function testCreateSupermarketEmployee()
    {
        // Mock the uploaded CSV file
        Storage::fake('local');
        $csvFile = UploadedFile::fake()->create('employees.csv', 1024);

        // Create a manager
        $manager = Manager::factory()->create();

        // Set up the request data
        $data = [
            'name' => 'Test Supermarket',
            'locationid' => 'Test Location',
            'csv_file' => $csvFile,
        ];

        // Mock the CSV import process
        Excel::fake();
        Excel::shouldReceive('import')->once();

        // Make a POST request to the store method
        $response = $this->post('/supermarket/employee', $data);

        // Assert that the supermarket was created
        $this->assertDatabaseHas('supermarkets', [
            'name' => 'Test Supermarket',
            'location' => 'Test Location',
        ]);

        // Assert that the CSV file was imported successfully
        $this->assertDatabaseHas('employees', [
            'name' => 'Employee 1',
            'type' => 'Backoffice',
            'manager_id' => $manager->id,
        ]);

        // Assert the response
        $response->assertRedirect('/home');
        $response->assertSessionHas('mssg', 'thanks for registration');
    }
}
