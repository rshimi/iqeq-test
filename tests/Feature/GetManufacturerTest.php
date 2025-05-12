<?php

namespace App\Tests\Feature;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetManufacturerTest extends WebTestCase
{
    /**
     * @dataProvider vehicleTypeDataAndExpectedManufacturerProvider
     */
    public function testGetManufacturerByTypeReturnsExpectedResponse(
        string $type,
        string $make,
    ): void {
        $client = static::createClient();

        $client->request('GET', '/manufacturer/type/'. $type);
        $response = $client->getResponse();
        $this->assertResponseStatusCodeSame(200);

        $decodedResponse = json_decode($response->getContent(), true);

        $this->assertSame(
            1,
            count($decodedResponse)
        );

        $this->assertSame(
            $make,
            $decodedResponse[0]['name']
        );
    }

    public function vehicleTypeDataAndExpectedManufacturerProvider(): array
    {
        return [
            ['SUV', 'Toyota'],
            ['Truck', 'Ford'],
        ];
    }
}
