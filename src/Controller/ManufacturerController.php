<?php

namespace App\Controller;

use App\Repository\VehicleInformationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/manufacturer')]
final class ManufacturerController extends AbstractController
{
    #[Route('/type/{type}', name: 'app_manufacturer_type', methods: ['GET'])]
    public function showByVehicleType(
        VehicleInformationRepository $vehicleInformationRepository,
        string $type
    ): Response {
        $result = [];
        $content = $vehicleInformationRepository->findByType($type);
        foreach ($content as $row) {
            $result[] = $row->getManufacturer()->jsonSerialize();
        }
        return new JsonResponse($result);
    }
}
