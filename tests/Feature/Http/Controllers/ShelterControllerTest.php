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
        $city = $this->faker->city;
        $region = $this->faker->word;
        $address = $this->faker->word;
        $lat = $this->faker->latitude;
        $lon = $this->faker->randomFloat(/** double_attributes **/);
        $balance_holder = $this->faker->word;
        $responsible_person = $this->faker->word;
        $capacity = $this->faker->numberBetween(-10000, 10000);
        $description = $this->faker->text;

        $response = $this->post(route('shelter.store'), [
            'city' => $city,
            'region' => $region,
            'address' => $address,
            'lat' => $lat,
            'lon' => $lon,
            'balance_holder' => $balance_holder,
            'responsible_person' => $responsible_person,
            'capacity' => $capacity,
            'description' => $description,
        ]);

        $shelters = Shelter::query()
            ->where('city', $city)
            ->where('region', $region)
            ->where('address', $address)
            ->where('lat', $lat)
            ->where('lon', $lon)
            ->where('balance_holder', $balance_holder)
            ->where('responsible_person', $responsible_person)
            ->where('capacity', $capacity)
            ->where('description', $description)
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
        $city = $this->faker->city;
        $region = $this->faker->word;
        $address = $this->faker->word;
        $lat = $this->faker->latitude;
        $lon = $this->faker->randomFloat(/** double_attributes **/);
        $balance_holder = $this->faker->word;
        $responsible_person = $this->faker->word;
        $capacity = $this->faker->numberBetween(-10000, 10000);
        $description = $this->faker->text;

        $response = $this->put(route('shelter.update', $shelter), [
            'city' => $city,
            'region' => $region,
            'address' => $address,
            'lat' => $lat,
            'lon' => $lon,
            'balance_holder' => $balance_holder,
            'responsible_person' => $responsible_person,
            'capacity' => $capacity,
            'description' => $description,
        ]);

        $shelter->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($city, $shelter->city);
        $this->assertEquals($region, $shelter->region);
        $this->assertEquals($address, $shelter->address);
        $this->assertEquals($lat, $shelter->lat);
        $this->assertEquals($lon, $shelter->lon);
        $this->assertEquals($balance_holder, $shelter->balance_holder);
        $this->assertEquals($responsible_person, $shelter->responsible_person);
        $this->assertEquals($capacity, $shelter->capacity);
        $this->assertEquals($description, $shelter->description);
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
