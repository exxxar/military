<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Person;
use App\Models\Uuid;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PeopleController
 */
class PeopleControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $people = People::factory()->count(3)->create();

        $response = $this->get(route('person.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PeopleController::class,
            'store',
            \App\Http\Requests\PeopleStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $uuid = Uuid::factory()->create();
        $sex = $this->faker->word;
        $status = $this->faker->numberBetween(-10000, 10000);
        $for = $this->faker->numberBetween(-10000, 10000);
        $is_active = $this->faker->boolean;
        $created_at = $this->faker->dateTime();
        $updated_at = $this->faker->dateTime();

        $response = $this->post(route('person.store'), [
            'uuid' => $uuid->id,
            'sex' => $sex,
            'status' => $status,
            'for' => $for,
            'is_active' => $is_active,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ]);

        $people = Person::query()
            ->where('uuid', $uuid->id)
            ->where('sex', $sex)
            ->where('status', $status)
            ->where('for', $for)
            ->where('is_active', $is_active)
            ->where('created_at', $created_at)
            ->where('updated_at', $updated_at)
            ->get();
        $this->assertCount(1, $people);
        $person = $people->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $person = People::factory()->create();

        $response = $this->get(route('person.show', $person));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PeopleController::class,
            'update',
            \App\Http\Requests\PeopleUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $person = People::factory()->create();
        $uuid = Uuid::factory()->create();
        $sex = $this->faker->word;
        $status = $this->faker->numberBetween(-10000, 10000);
        $for = $this->faker->numberBetween(-10000, 10000);
        $is_active = $this->faker->boolean;
        $created_at = $this->faker->dateTime();
        $updated_at = $this->faker->dateTime();

        $response = $this->put(route('person.update', $person), [
            'uuid' => $uuid->id,
            'sex' => $sex,
            'status' => $status,
            'for' => $for,
            'is_active' => $is_active,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ]);

        $person->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($uuid->id, $person->uuid);
        $this->assertEquals($sex, $person->sex);
        $this->assertEquals($status, $person->status);
        $this->assertEquals($for, $person->for);
        $this->assertEquals($is_active, $person->is_active);
        $this->assertEquals($created_at, $person->created_at);
        $this->assertEquals($updated_at, $person->updated_at);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $person = People::factory()->create();
        $person = Person::factory()->create();

        $response = $this->delete(route('person.destroy', $person));

        $response->assertNoContent();

        $this->assertDeleted($person);
    }
}
