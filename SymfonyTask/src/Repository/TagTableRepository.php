<?php

namespace App\Repository;

use App\Entity\TagTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TagTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method TagTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method TagTable[]    findAll()
 * @method TagTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TagTable::class);
    }

    // /**
    //  * @return TagTable[] Returns an array of TagTable objects
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
    public function findOneBySomeField($value): ?TagTable
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
