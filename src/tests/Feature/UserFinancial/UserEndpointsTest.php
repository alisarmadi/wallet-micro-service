<?php

namespace Tests\Feature\UserFinancial;

use Illuminate\Http\Response;
use Tests\BaseDataTestCase;

class UserEndpointsTest extends BaseDataTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function transactionHappyTest()
    {
        $response = $this->post(route('add-money', ['userId' => 1]), [ 'amount' => 100]);
        $responseData = json_decode($response->response->getContent(), true);
        $response->response->assertStatus(Response::HTTP_OK);
        $response->response->assertJsonStructure(['reference_id']);
        $this->assertEquals(1, $responseData[ 'reference_id' ]);

        $response = $this->post(route('add-money', ['userId' => 1]), [ 'amount' => -50]);
        $responseData = json_decode($response->response->getContent(), true);
        $response->response->assertStatus(Response::HTTP_OK);
        $response->response->assertJsonStructure(['reference_id']);
        $this->assertEquals(2, $responseData[ 'reference_id' ]);


        $response = $this->get(route('get-balance', ['userId' => 1]));
        $responseData = json_decode($response->response->getContent(), true);
        $response->response->assertStatus(Response::HTTP_OK);
        $response->response->assertJsonStructure(['balance']);
        $this->assertEquals(50, $responseData[ 'balance' ]);
    }
}
