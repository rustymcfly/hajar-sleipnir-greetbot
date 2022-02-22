<?php

namespace App\Repository;

use App\Entity\Discord\PermissionOverwrite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PermissionOverwrite|null find($id, $lockMode = null, $lockVersion = null)
 * @method PermissionOverwrite|null findOneBy(array $criteria, array $orderBy = null)
 * @method PermissionOverwrite[]    findAll()
 * @method PermissionOverwrite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PermissionOverwriteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PermissionOverwrite::class);
    }

//    /**
//     * @return Emoji Returns an array of User objects
//     */
//    public function findByGuildId($value)
//    {
//        $result = $this->createQueryBuilder('g')
//            ->andWhere('g.guild_id = :val')
//            ->setParameter('val', $value)
//            ->setMaxResults(1)
//            ->getQuery()
//            ->getResult();
//
//        if(count($result)) {
//            return $result[0];
//        } else {
//            return null;
//        }
//    }
}
