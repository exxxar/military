<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\HumanitarianAidHistory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\HumanitarianAidHistoryController
 */
class HumanitarianAidHistoryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $humanitarianAidHistories = HumanitarianAidHistory::factory()->count(3)->create();

        $response = $this->get(route('humanitarian-aid-history.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HumanitarianAidHistoryController::class,
            'store',
            \App\Http\Requests\HumanitarianAidHistoryStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $created_at = $this->faker->dateTime();
        $updated_at = $this->faker->dateTime();

        $response = $this->post(route('humanitarian-aid-history.store'), [
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ]);

        $humanitarianAidHistories = HumanitarianAidHistory::query()
            ->where('created_at', $created_at)
            ->where('updated_at', $updated_at)
            ->get();
        $this->assertCount(1, $humanitarianAidHistories);
        $humanitarianAidHistory = $humanitarianAidHistories->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $humanitarianAidHistory = HumanitarianAidHistory::factory()->create();

        $response = $this->get(route('humanitarian-aid-history.show', $humanitarianAidHistory));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HumanitarianAidHistoryController::class,
            'update',
            \App\Http\Requests\HumanitarianAidHistoryUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $humanitarianAidHistory = HumanitarianAidHistory::factory()->create();
        $created_at = $this->faker->dateTime();
        $updated_at = $this->faker->dateTime();

        $response = $this->put(route('humanitarian-aid-history.update', $humanitarianAidHistory), [
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ]);

        $humanitarianAidHistory->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($created_at, $humanitarianAidHistory->created_at);
        $this->assertEquals($updated_at, $humanitarianAidHistory->updated_at);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $humanitarianAidHistory = HumanitarianAidHistory::factory()->create();

        $response = $this->delete(route('humanitarian-aid-history.destroy', $humanitarianAidHistory));

        $response->assertNoContent();

        $this->assertDeleted($humanitarianAidHistory);
    }
}
