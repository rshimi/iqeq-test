<?php

namespace App\Repository;

use App\Entity\Manufacturer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Manufacturer>
 */
class ManufacturerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Manufacturer::class);
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
}
