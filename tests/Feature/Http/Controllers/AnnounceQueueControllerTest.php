<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\AnnounceQueue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AnnounceQueueController
 */
class AnnounceQueueControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $announceQueues = AnnounceQueue::factory()->count(3)->create();

        $response = $this->get(route('announce-queue.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AnnounceQueueController::class,
            'store',
            \App\Http\Requests\AnnounceQueueStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $response = $this->post(route('announce-queue.store'));

        $response->assertCreated();
        $response->assertJsonStructure([]);

        $this->assertDatabaseHas(announceQueues, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $announceQueue = AnnounceQueue::factory()->create();

        $response = $this->get(route('announce-queue.show', $announceQueue));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AnnounceQueueController::class,
            'update',
            \App\Http\Requests\AnnounceQueueUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $announceQueue = AnnounceQueue::factory()->create();

        $response = $this->put(route('announce-queue.update', $announceQueue));

        $announceQueue->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $announceQueue = AnnounceQueue::factory()->create();

        $response = $this->delete(route('announce-queue.destroy', $announceQueue));

        $response->assertNoContent();

        $this->assertSoftDeleted($announceQueue);
    }
}
