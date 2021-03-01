<?php

namespace App\Repository;

use App\Entity\Quisommesnous;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Quisommesnous|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quisommesnous|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quisommesnous[]    findAll()
 * @method Quisommesnous[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuisommesnousRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quisommesnous::class);
    }

    // /**
    //  * @return Quisommesnous[] Returns an array of Quisommesnous objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Quisommesnous
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
