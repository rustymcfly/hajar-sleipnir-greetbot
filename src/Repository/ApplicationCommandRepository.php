<?php

namespace App\Repository;

use App\Entity\ApplicationCommand;
use App\Entity\Discord\Guild;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ApplicationCommand|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicationCommand|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicationCommand[]    findAll()
 * @method ApplicationCommand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationCommandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Guild::class);
    }

    /**
     * @return ApplicationCommand Returns an array of User objects
     */
    public function findByNameAndGuildId($name, $guild_id)
    {
        return $this->createQueryBuilder('application_command')
            ->andWhere('application_command.guild_id = :guild_id')
            ->andWhere('application_command.name = :name')
            ->setParameter('guild_id', $guild_id)
            ->setParameter('name', $name)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }
}
