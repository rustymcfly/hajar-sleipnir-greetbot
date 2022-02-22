<?php

namespace App\Repository;

use App\Entity\Discord\Channel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Channel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Channel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Channel[]    findAll()
 * @method Channel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChannelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Channel::class);
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
