<?php

namespace App\Entity\Discord;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ThreadMemberRepository;
/**
 * @ORM\Entity(repositoryClass=ThreadMemberRepository::class)
 */
class ThreadMember
{
    /**
     * @ORM\Id
     * @see Snowflake
     * @var string the id of the thread [optional]
     * @ORM\Column(type="string")
     */
    private string $id;
    /**
     * @see Snowflake
     * @var string  the id of the user [optional]
     * @ORM\Column(type="string")
     */
    private string $user_id;

    /**
     * @var \DateTime ISO8601 timestamp the time the current user last joined the thread
     * @ORM\Column(type="datetime")
     */
    private \DateTime $join_timestamp;

    /**
     * @var int any user-thread settings, currently only used for notifications
     * @ORM\Column(type="integer")
     */
    private int $flags;
}
