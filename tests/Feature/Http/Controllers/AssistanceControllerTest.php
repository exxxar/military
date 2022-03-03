<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Assistance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AssistanceController
 */
class AssistanceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $assistances = Assistance::factory()->count(3)->create();

        $response = $this->get(route('assistance.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AssistanceController::class,
            'store',
            \App\Http\Requests\AssistanceStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $response = $this->post(route('assistance.store'));

        $response->assertCreated();
        $response->assertJsonStructure([]);

        $this->assertDatabaseHas(assistances, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $assistance = Assistance::factory()->create();

        $response = $this->get(route('assistance.show', $assistance));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AssistanceController::class,
            'update',
            \App\Http\Requests\AssistanceUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $assistance = Assistance::factory()->create();

        $response = $this->put(route('assistance.update', $assistance));

        $assistance->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $assistance = Assistance::factory()->create();

        $response = $this->delete(route('assistance.destroy', $assistance));

        $response->assertNoContent();

        $this->assertDeleted($assistance);
    }
}
