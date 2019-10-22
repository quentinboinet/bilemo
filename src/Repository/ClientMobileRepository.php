<?php

namespace App\Repository;

use App\Entity\ClientMobile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ClientMobile|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientMobile|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientMobile[]    findAll()
 * @method ClientMobile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientMobileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientMobile::class);
    }

    // /**
    //  * @return ClientMobile[] Returns an array of ClientMobile objects
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
    public function findOneBySomeField($value): ?ClientMobile
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
