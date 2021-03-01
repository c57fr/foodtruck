<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Categorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorie[]    findAll()
 * @method Categorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorie::class);
    }

    // /**
    //  * @return Categorie[] Returns an array of Categorie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Categorie
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findSingleFullCategorie(int $id)
    {
        
        // createQueryBuilder, dans un repository, ajoute déjà le FROM Bar et le SELECT c
        return $this->createQueryBuilder('c')
        
            // Si on ne précise en SQL ou en QB le type de join, on fait un INNER JOIN
            ->leftJoin('c.produits', 'p')
            // Si on veut obtenir les objets produits dans les résultats, il faut ajouter un select
            ->addSelect('p')

            // // Les autres jointures
            //->leftJoin('b.barman', 'e')
            //->addSelect('e')
            //->leftJoin('e.person', 'p')
            //->addSelect('p')

            // On précise qu'on veut un bar selon son id
            ->where('c.id = :id')
            ->setParameter('id', $id)

            ->getQuery()
            // getSingleResult s'attend à retrouver un seul résultat et au moins un résultat
            // Donc s'il n'y a aucun résultat (par exemple lîd n'existe pas), on obtient une erreur
            // On utilise donc getOneOrNullResult() pour autorise à n'avoir aucun résultat et retourner un null si besoin
            // ->getSingleResult()
            ->getOneOrNullResult()
        ;
    }
}
