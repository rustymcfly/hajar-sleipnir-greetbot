<?php

namespace App\Repository;

use App\Entity\Discord\Guild;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Guild|null find($id, $lockMode = null, $lockVersion = null)
 * @method Guild|null findOneBy(array $criteria, array $orderBy = null)
 * @method Guild[]    findAll()
 * @method Guild[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GuildRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Guild::class);
    }

    /**
     * @return Guild Returns an array of User objects
     */
    public function findByGuildId($value)
    {
        $result = $this->createQueryBuilder('g')
            ->andWhere('g.guild_id = :val')
            ->setParameter('val', $value)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();

        if(count($result)) {
            return $result[0];
        } else {
            return null;
        }
    }
}
