<?php

namespace App\Repository;

use App\Entity\ProjectTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjectTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectTypes[]    findAll()
 * @method ProjectTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectTypes::class);
    }

    // /**
    //  * @return ProjectTypes[] Returns an array of ProjectTypes objects
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
    public function findOneBySomeField($value): ?ProjectTypes
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
