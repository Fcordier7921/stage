<?php

namespace App\Repository;

use App\Entity\AnnonceEntreprise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AnnonceEntreprise|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnnonceEntreprise|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnnonceEntreprise[]    findAll()
 * @method AnnonceEntreprise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnonceEntrepriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnnonceEntreprise::class);
    }

    // /**
    //  * @return AnnonceEntreprise[] Returns an array of AnnonceEntreprise objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AnnonceEntreprise
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
}
