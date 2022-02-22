<?php

namespace App\Repository;

use App\Entity\Discord\Emoji;
use App\Entity\Discord\Guild;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Emoji|null find($id, $lockMode = null, $lockVersion = null)
 * @method Emoji|null findOneBy(array $criteria, array $orderBy = null)
 * @method Emoji[]    findAll()
 * @method Emoji[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmojiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Emoji::class);
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
