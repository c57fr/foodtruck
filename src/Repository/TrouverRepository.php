<?php

namespace App\Repository;

use App\Entity\Trouver;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Trouver|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trouver|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trouver[]    findAll()
 * @method Trouver[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrouverRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trouver::class);
    }

    // /**
    //  * @return Trouver[] Returns an array of Trouver objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Trouver
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
