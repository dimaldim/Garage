<?php

namespace App\Repository;

use App\Entity\VehicleActivity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method VehicleActivity|null find($id, $lockMode = null, $lockVersion = null)
 * @method VehicleActivity|null findOneBy(array $criteria, array $orderBy = null)
 * @method VehicleActivity[]    findAll()
 * @method VehicleActivity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleActivityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VehicleActivity::class);
    }

    // /**
    //  * @return VehicleActivity[] Returns an array of VehicleActivity objects
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
    public function findOneBySomeField($value): ?VehicleActivity
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
