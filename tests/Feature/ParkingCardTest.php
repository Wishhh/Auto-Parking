<?php

namespace Tests\Feature;

use App\Models\ParkingCard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class ParkingCardTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_parking_cards()
    {
        // Create test parking cards
        ParkingCard::create([
            'entering_date' => '2024-02-01',
            'car_number' => 'ABC-123',
            'car_model' => 'Toyota Camry',
            'car_size' => 5
        ]);

        $response = $this->get(route('parking_cards.index'));
        $response->assertStatus(200);
        $response->assertSee('ABC-123');
        $response->assertSee('Toyota Camry');
    }

    public function test_create_displays_form()
    {
        $response = $this->get(route('parking_cards.create'));
        $response->assertStatus(200);
        $response->assertSee('პარკინგის ბარათის დამატება');
    }

    public function test_store_creates_new_parking_card()
    {
        $data = [
            'entering_date' => '2024-02-01',
            'car_number' => 'ABC-123',
            'car_model' => 'Toyota Camry',
            'car_size' => 5
        ];

        $response = $this->post(route('parking_cards.store'), $data);
        $response->assertRedirect(route('parking_cards.index'));
        $this->assertDatabaseHas('parking_cards', $data);
    }

    public function test_edit_displays_form()
    {
        $parkingCard = ParkingCard::create([
            'entering_date' => '2024-02-01',
            'car_number' => 'ABC-123',
            'car_model' => 'Toyota Camry',
            'car_size' => 5
        ]);

        $response = $this->get(route('parking_cards.edit', $parkingCard));
        $response->assertStatus(200);
        $response->assertSee('ABC-123');
        $response->assertSee('Toyota Camry');
    }

    public function test_update_modifies_parking_card()
    {
        $parkingCard = ParkingCard::create([
            'entering_date' => '2024-02-01',
            'car_number' => 'ABC-123',
            'car_model' => 'Toyota Camry',
            'car_size' => 5
        ]);

        $data = [
            'entering_date' => '2024-02-02',
            'car_number' => 'XYZ-789',
            'car_model' => 'BMW X5',
            'car_size' => 7
        ];

        $response = $this->put(route('parking_cards.update', $parkingCard), $data);
        $response->assertRedirect(route('parking_cards.index'));
        $this->assertDatabaseHas('parking_cards', $data);
    }

    public function test_destroy_removes_parking_card()
    {
        $parkingCard = ParkingCard::create([
            'entering_date' => '2024-02-01',
            'car_number' => 'ABC-123',
            'car_model' => 'Toyota Camry',
            'car_size' => 5
        ]);

        $response = $this->delete(route('parking_cards.destroy', $parkingCard));
        $response->assertRedirect(route('parking_cards.index'));
        $this->assertDatabaseMissing('parking_cards', ['id' => $parkingCard->id]);
    }

    public function test_reports_displays_analytics()
    {
        // Create test parking cards with different dates
        ParkingCard::create([
            'entering_date' => Carbon::now()->subDays(5),
            'car_number' => 'ABC-123',
            'car_model' => 'Toyota Camry',
            'car_size' => 5
        ]);

        ParkingCard::create([
            'entering_date' => Carbon::now()->subDays(3),
            'car_number' => 'XYZ-789',
            'car_model' => 'BMW X5',
            'car_size' => 7
        ]);

        $response = $this->get(route('parking_cards.reports'));
        $response->assertStatus(200);
        $response->assertSee('პარკინგის ანგარიშგება');
        
        // Test that the response contains chart data
        $response->assertSee('usageChart');
        $response->assertSee('revenueChart');
        $response->assertSee('peakHoursChart');
    }

    public function test_validation_rules()
    {
        $response = $this->post(route('parking_cards.store'), []);
        $response->assertSessionHasErrors(['entering_date', 'car_number', 'car_model', 'car_size']);

        $response = $this->post(route('parking_cards.store'), [
            'entering_date' => 'invalid-date',
            'car_number' => '',
            'car_model' => '',
            'car_size' => 'not-a-number'
        ]);
        $response->assertSessionHasErrors(['entering_date', 'car_number', 'car_model', 'car_size']);

        $response = $this->post(route('parking_cards.store'), [
            'entering_date' => '2024-02-01',
            'car_number' => 'ABC-123',
            'car_model' => 'Toyota Camry',
            'car_size' => 0
        ]);
        $response->assertSessionHasErrors(['car_size']);
    }

    public function test_price_calculation()
    {
        $enteringDate = Carbon::now()->subDays(5);
        $parkingCard = ParkingCard::create([
            'entering_date' => $enteringDate,
            'car_number' => 'ABC-123',
            'car_model' => 'Toyota Camry',
            'car_size' => 5
        ]);

        $response = $this->get(route('parking_cards.index'));
        $response->assertStatus(200);

        // Price should be: 5 days * car_size(5) = 25
        $response->assertSee('25');
    }
}
