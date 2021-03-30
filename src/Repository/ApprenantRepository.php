<?php

namespace App\Repository;

use App\Entity\Apprenant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method Apprenant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Apprenant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Apprenant[]    findAll()
 * @method Apprenant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApprenantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Apprenant::class);
    }

    //**
    //  * @return Apprenant[] Returns an array of Apprenant objects
    //  */
    
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.users = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    
    public function findOneBySomeField($value): ?Apprenant
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
    /**
     * conter les apprenant
     *
     * @return int|mixed|string
     */
    public function countAllApprenant()
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder->select('COUNT(a.id) as value');
        
        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    public function findApprenantsNegatif($ids)
    {   

        $em = $this->getEntityManager();
        return $em->createQueryBuilder()
        ->select(['a', 'MAX(c.date_candidature)', 'GROUP_CONCAT(c.statut SEPARATOR '|') as statuts'])
        ->from('App\Entity\Apprenant', 'a')
        ->join('App\Entity\Candidature', 'c', 'WITH', 'a.id=c.apprenant')
        ->setParameter('statut', 'En attente')
        ->setParameter('id', $ids)
        ->andWhere('c.statut = :statut')
        ->andWhere('a.id not in(:id)')
        // ->andWhere("a.id not in(SELECT a2.id FROM App\Entity\Apprenant as a2 LEFT JOIN App\Entity\Candidature as c2 ON (a2.id=c2.apprenant) WHERE c2.statut <> 'Positif')")
        ->groupBy('a.id')
        ->orderBy('a.id', 'ASC')
        ->setMaxResults(10)
        ->getQuery()
        ->getResult()
    ;
    }
    



}
