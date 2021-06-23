<?php

namespace App\Repository;

use App\Entity\CommentTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommentTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentTable[]    findAll()
 * @method CommentTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentTable::class);
    }

    // /**
    //  * @return CommentTable[] Returns an array of CommentTable objects
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
    public function findOneBySomeField($value): ?CommentTable
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
