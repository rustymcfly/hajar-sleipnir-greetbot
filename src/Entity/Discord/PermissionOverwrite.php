<?php

namespace App\Entity\Discord;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PermissionOverwriteRepository;
/**
 * @see https://discord.com/developers/docs/topics/permissions#permissions
 * @ORM\Entity(repositoryClass=PermissionOverwriteRepository::class)
 */
class PermissionOverwrite
{
    /**
     * @var string
     * @see Snowflake
     * role or user id
     *
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private string $id;

    /**
     * @var int
     * either 0 (role) or 1 (member)
     * @ORM\Column(type="integer")
     */
    private int $type;

    /**
     * @var string
     * permission bit set
     *
     * @ORM\Column(type="string")
     */
    private string $allow;

    /**
     * @var string
     * permission bit set
     *
     * @ORM\Column(type="string")
     */
    private string $deny;
}
