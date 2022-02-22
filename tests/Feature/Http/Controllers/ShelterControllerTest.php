<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Shelter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ShelterController
 */
class ShelterControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $shelters = Shelter::factory()->count(3)->create();

        $response = $this->get(route('shelter.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ShelterController::class,
            'store',
            \App\Http\Requests\ShelterStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $address = $this->faker->word;
        $lat = $this->faker->latitude;
        $lon = $this->faker->randomFloat(/** double_attributes **/);
        $capacity = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('shelter.store'), [
            'address' => $address,
            'lat' => $lat,
            'lon' => $lon,
            'capacity' => $capacity,
        ]);

        $shelters = Shelter::query()
            ->where('address', $address)
            ->where('lat', $lat)
            ->where('lon', $lon)
            ->where('capacity', $capacity)
            ->get();
        $this->assertCount(1, $shelters);
        $shelter = $shelters->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $shelter = Shelter::factory()->create();

        $response = $this->get(route('shelter.show', $shelter));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ShelterController::class,
            'update',
            \App\Http\Requests\ShelterUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $shelter = Shelter::factory()->create();
        $address = $this->faker->word;
        $lat = $this->faker->latitude;
        $lon = $this->faker->randomFloat(/** double_attributes **/);
        $capacity = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('shelter.update', $shelter), [
            'address' => $address,
            'lat' => $lat,
            'lon' => $lon,
            'capacity' => $capacity,
        ]);

        $shelter->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($address, $shelter->address);
        $this->assertEquals($lat, $shelter->lat);
        $this->assertEquals($lon, $shelter->lon);
        $this->assertEquals($capacity, $shelter->capacity);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $shelter = Shelter::factory()->create();

        $response = $this->delete(route('shelter.destroy', $shelter));

        $response->assertNoContent();

        $this->assertDeleted($shelter);
    }
}
