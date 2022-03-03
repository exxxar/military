<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\AidCenter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AidCenterController
 */
class AidCenterControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $aidCenters = AidCenter::factory()->count(3)->create();

        $response = $this->get(route('aid-center.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AidCenterController::class,
            'store',
            \App\Http\Requests\AidCenterStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $address = $this->faker->word;
        $phone = $this->faker->phoneNumber;

        $response = $this->post(route('aid-center.store'), [
            'address' => $address,
            'phone' => $phone,
        ]);

        $aidCenters = AidCenter::query()
            ->where('address', $address)
            ->where('phone', $phone)
            ->get();
        $this->assertCount(1, $aidCenters);
        $aidCenter = $aidCenters->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $aidCenter = AidCenter::factory()->create();

        $response = $this->get(route('aid-center.show', $aidCenter));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AidCenterController::class,
            'update',
            \App\Http\Requests\AidCenterUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $aidCenter = AidCenter::factory()->create();
        $address = $this->faker->word;
        $phone = $this->faker->phoneNumber;

        $response = $this->put(route('aid-center.update', $aidCenter), [
            'address' => $address,
            'phone' => $phone,
        ]);

        $aidCenter->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($address, $aidCenter->address);
        $this->assertEquals($phone, $aidCenter->phone);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $aidCenter = AidCenter::factory()->create();

        $response = $this->delete(route('aid-center.destroy', $aidCenter));

        $response->assertNoContent();

        $this->assertDeleted($aidCenter);
    }
}
