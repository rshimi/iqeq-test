<?php

namespace App\Repository;

use App\Entity\VehicleInformation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class VehicleInformationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VehicleInformation::class);
    }

    public function findAll(): array
    {
        $queryBuilder = $this->createQueryBuilder('i');

        return $queryBuilder
            ->select('i')
            ->getQuery()
            ->getArrayResult();
    }

    public function findByType(string $type): array
    {
        $queryBuilder = $this->createQueryBuilder('i');
        $queryBuilder->where('i.type = :type')
            ->setParameter('type', $type);

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    public function findById(int $id): array
    {
        $queryBuilder = $this->createQueryBuilder('i');
        $queryBuilder->where('i.id = :id')
            ->setParameter('id', $id);

        return $queryBuilder
            ->getQuery()
            ->getArrayResult();
    }
}
