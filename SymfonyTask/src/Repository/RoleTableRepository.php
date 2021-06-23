<?php

namespace App\Repository;

use App\Entity\RoleTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RoleTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoleTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoleTable[]    findAll()
 * @method RoleTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoleTable::class);
    }

    // /**
    //  * @return RoleTable[] Returns an array of RoleTable objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RoleTable
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
