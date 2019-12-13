<?php

namespace App\Repository;

use App\Entity\VehicleDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method VehicleDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method VehicleDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method VehicleDetails[]    findAll()
 * @method VehicleDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleDetailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VehicleDetails::class);
    }

    // /**
    //  * @return VehicleDetails[] Returns an array of VehicleDetails objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VehicleDetails
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
