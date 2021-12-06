<?php

namespace App\Repository;

use App\Entity\Trek;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Trek|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trek|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trek[]    findAll()
 * @method Trek[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrekRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trek::class);
    }

    // /**
    //  * @return Trek[] Returns an array of Trek objects
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
    public function findOneBySomeField($value): ?Trek
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
