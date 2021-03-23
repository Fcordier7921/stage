<?php

namespace App\Repository;

use App\Entity\Candidature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Candidature|null find($id, $lockMode = null, $lockVersion = null)
 * @method Candidature|null findOneBy(array $criteria, array $orderBy = null)
 * @method Candidature[]    findAll()
 * @method Candidature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Candidature::class);
    }

    /**
    * @return Candidature[] Returns an array of Candidature objects
    */
    
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.Users = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    
    public function findOneBySomeField($value)//selectionner tout les candidature non positive
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.statut != :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }


    //renvoi tout la apprenant ayant trouver un stage
    public function countAppPositif()
    {
        $builder=$this->createQueryBuilder('p');
        $query=$builder->andWhere('p.statut = :val')
                        ->setParameter('val', 'Positif')
                        ->getQuery()
                        ->getResult();
        $queryDoublon=[];
        $queryResult=[];
            for($i=0; $i<count($query); $i++)
            {
              $idApprenant=$query[$i]->getApprenant()->getId();
              
                if(in_array($idApprenant, $queryDoublon))
                {  
                    //ne rien faire
                }
                else
                {
                    array_push($queryDoublon, $idApprenant);
                    array_push($queryResult, $query[$i]);
                }
               
            }
                     
        
        return $queryResult;
    }

    
}
