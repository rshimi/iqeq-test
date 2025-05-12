<?php

namespace App\Tests\Feature;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetVehicleInformationTest extends WebTestCase
{
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
            $decodedResponse['make']
        );

       $this->assertSame(
           $model,
           $decodedResponse['model']
       );
    }

    public function vehicleTypeSpecificDataAndExpectedDataProvider(): array
    {
        return [
            [1, 'Ford', 'F-150'],
            [2, 'Toyota', 'Camry'],
        ];
    }
}
