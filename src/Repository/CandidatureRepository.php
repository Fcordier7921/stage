<?php

namespace App\Repository;

use App\Entity\Candidature;
use DateTime;
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

     
    public function findApprenantentretien()//selectionner tout les candidature avec un entretien
    {
        $builder=$this->createQueryBuilder('c');
        $query=$builder->andWhere('c.date_entretient IS NOT NULL')
            ->andWhere("c.statut NOT IN('Positif', 'Négatif')")
            ->getQuery()
            ->getResult()
            ;
        $builderPositif=$this->createQueryBuilder('e');
        $queryPositif=$builderPositif->andWhere("e.statut = 'Positif'")
                        ->getQuery()
                        ->getResult()
                        ;
        $queryApp=[];
        $queryPositifApp=[];
        for($i=0; $i<count($query); $i++){
            array_push($queryApp, $query[$i]->getApprenant()); 
        }
        for($i=0; $i<count($queryPositif); $i++){
            array_push($queryPositifApp, $queryPositif[$i]->getApprenant()); 
        }
        for($i=0; $i<count($query); $i++){
            if(in_array($queryApp[$i], $queryPositifApp)){
                Unset($query[$i]);
            }
        }
       return $query;
    }
  

    
    public function findApprenantsNegatif()//selectionner tout les candidature sans stage
    {
        $builderPositif=$this->createQueryBuilder('e');
        $queryPositif=$builderPositif->andWhere("e.statut = 'Positif'")
                        ->orWhere("e.statut IN ('En attente', 'Relancée')")
                        ->andWhere("e.date_entretient IS NOT NULL")
                        ->groupBy("e.apprenant")
                        ->getQuery()
                        ->getResult()
                        ;
        $idAppPositif=array_map(function($el){return $el->getApprenant()->getId();},array_values($queryPositif));
        dd([$idAppPositif, $queryPositif]);
        $builder=$this->createQueryBuilder('f');
        $query=$builder->andWhere('f.date_entretient IS NULL')
            ->andWhere("f.statut IN ('En attente', 'Relancée')")
            ->andWhere("f.apprenant NOT IN (:ids) ")
            ->setParameter('ids', $idAppPositif )
            ->groupBy("f.apprenant")
            ->orderBy('f.date_candidature', 'DESC')
            ->getQuery()
            ->getResult()
            ;
            dd($query);
        
       return $query;
    }
}
