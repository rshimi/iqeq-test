<?php

namespace App\Tests\Feature;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class EditVehicleInformationTest extends WebTestCase
{
    public function testEditVehicleInformationReturnsExpectedErrorCodeWhenUserIsNotLoggedIn(): void
    {
        $client = static::createClient([], ['HTTP_HOST' => 'localhost:8000']);

        $client->request('PUT', '/vehicle/information/4', [
            'colour' => 'Pink'
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }
}
