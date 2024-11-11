<?php

namespace App\Repository;

use App\Entity\TaskStats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TaskStats>
 *
 * @method TaskStats|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaskStats|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaskStats[]    findAll()
 * @method TaskStats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskStatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskStats::class);
    }

//    /**
//     * @return TaskStats[] Returns an array of TaskStats objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TaskStats
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
