<?php

namespace App\Repository;

use App\Entity\Discord\ThreadMember;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ThreadMember|null find($id, $lockMode = null, $lockVersion = null)
 * @method ThreadMember|null findOneBy(array $criteria, array $orderBy = null)
 * @method ThreadMember[]    findAll()
 * @method ThreadMember[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThreadMemberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ThreadMember::class);
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
