<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    public function findForHomepage()
    {
        return $this->createQueryBuilder('p')
            ->setMaxResults(3)
            ->orderBy('p.id', 'DESC')
            // ->addOrderBy('m.title')
            // On enlève le tri par titres. Si on demande à Doctrine de s'en charger, le tri est faussé car la logique de MySQL c'est que qu'un tri sur deux champs à la fois se fait d'abord sur le premier, et si sur le premier on a des résultats identiques, on tri entre ces résultats selon le second champs
            // Comme un tri par Nom, Prénom, si on a deux noms identiques, on tri par prénoms
            ->getQuery()
            ->getResult()
            // On souhaite trier les résultats par titres
            // 1ère solution : On pourrait utiliser un algorithme de tri en fonction de la valeur des titres dans les objets Movie dans le tableau de résultat.
            // Cette solution est un peu complexe et c'est pas le but du cours d'aujourd'hui
            // 2ème solution : On peut faire trier les résultats par Twig avec le filtre |sort()
        ;
    }
    

    public function findCategorieProduit($id)
    {
        //dd($id,$categorieId);
        // createQueryBuilder, dans un repository, ajoute déjà le FROM produit et le SELECT p
        return $this->createQueryBuilder('p')
        
            // Si on ne précise en SQL ou en QB le type de join, on fait un INNER JOIN
            ->leftJoin('p.categorie', 'c')
            // Si on veut obtenir les objets bars dans les résultats, il faut ajouter un select
            ->addSelect('c')

            // // Les autres jointures
            //->leftJoin('p.bar', 'b')
            //->addSelect('b')
            //->leftJoin('e.person', 'p')
            //->addSelect('p')
            ->Where('c.id = :id')
            ->setParameter('id', $id)
            // On précise qu'on veut un produit selon son id
            

            ->getQuery()
            // getSingleResult s'attend à retrouver un seul résultat et au moins un résultat
            // Donc s'il n'y a aucun résultat (par exemple lîd n'existe pas), on obtient une erreur
            // On utilise donc getOneOrNullResult() pour autorise à n'avoir aucun résultat et retourner un null si besoin
             ->getResult()
            //->getOneOrNullResult()
        ;
    }


    // /**
    //  * @return Produit[] Returns an array of Produit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Produit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
}