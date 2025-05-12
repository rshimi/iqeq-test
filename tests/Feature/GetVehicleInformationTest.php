<?php

namespace App\Tests\Feature;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetVehicleInformationTest extends WebTestCase
{
    /**
     * @dataProvider vehicleTypeDataAndExpectedMakeProvider
     */
    public function testGetVehicleInformationByTypeReturnsExpectedResponse(
        string $type,
        string $make,
    ): void {
        $client = static::createClient();

        $client->request('GET', '/vehicle/information/type/'. $type);
        $response = $client->getResponse();
        $this->assertResponseStatusCodeSame(200);

        $decodedResponse = json_decode($response->getContent(), true);
        $this->assertSame(
            1,
            count($decodedResponse)
        );

        $this->assertSame(
            $make,
            $decodedResponse[0]['make']
        );
    }

    /**
     * @dataProvider vehicleTypeSpecificDataAndExpectedDataProvider
     */
   public function testGetVehicleInformationByExpectedVehicle(
        int $id,
        string $make,
        string $model,
   ): void {
        $client = static::createClient();
        $client->request('GET', '/vehicle/information/'. $id);

        $response = $client->getResponse();
        $this->assertResponseStatusCodeSame(200);

        $decodedResponse = json_decode($response->getContent(), true);

        $this->assertSame(
            $make,
            $decodedResponse[0]['make']
        );

       $this->assertSame(
           $model,
           $decodedResponse[0]['model']
       );
    }

    public function vehicleTypeDataAndExpectedMakeProvider(): array
    {
        return [
            ['SUV', 'toyota'],
            ['Truck', 'Ford'],
        ];
    }

    public function vehicleTypeSpecificDataAndExpectedDataProvider(): array
    {
        return [
            [3, 'toyota', 'F-150'],
            [4, 'Ford', 'Camry'],
        ];
    }
}
