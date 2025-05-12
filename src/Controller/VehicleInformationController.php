<?php

namespace App\Controller;

use App\Entity\VehicleInformation;
use App\Repository\VehicleInformationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/vehicle/information')]
final class VehicleInformationController extends AbstractController
{
    #[Route(name: 'app_vehicle_information_index', methods: ['GET'])]
    public function index(
        VehicleInformationRepository $vehicleInformationRepository,
    ): Response {
        return new JsonResponse($vehicleInformationRepository->findAll());
    }

    #[Route('/type/{type}', name: 'app_vehicle_information_type', methods: ['GET'])]
    public function showByVehicleType(
        VehicleInformationRepository $vehicleInformationRepository,
        string $type
    ): Response {
        return new JsonResponse($vehicleInformationRepository->findByType($type));
    }

    #[Route('/{id}', name: 'app_vehicle_information_show', methods: ['GET'])]
    public function show(
        VehicleInformation $vehicleInformation,
    ): Response {
        return new JsonResponse($vehicleInformation->jsonSerialize());
    }

    #[Route('/{id}', name: 'app_vehicle_information_edit', methods: ['PUT'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function edit(
        Request $request,
        VehicleInformation $vehicleInformation,
        EntityManagerInterface $entityManager,
        SerializerInterface  $serializer
    ): Response {
        $requestData = $request->getContent();
        $serializer->deserialize(
            $requestData,
            VehicleInformation::class,
            'json',
            ['object_to_populate' => $vehicleInformation]
        );

        $entityManager->flush();

        return new JsonResponse($vehicleInformation->jsonSerialize());
    }
}
