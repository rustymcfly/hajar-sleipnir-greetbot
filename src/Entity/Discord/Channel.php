<?php

namespace App\Entity\Discord;

use App\Entity\User;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ChannelRepository;

/**
 * @ORM\Entity(repositoryClass=ChannelRepository::class)
 */
class Channel
{
    /**
     * @var string the id of this channel
     * @see Snowflake
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private string $id;
    /**
     * @var int the type of channel
     * @see ChannelType
     * @ORM\Column(type="int")
     */
    private int $type;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Discord\Guild", inversedBy="id")
     * @ORM\JoinColumn(referencedColumnName="id")
     * @see Snowflake
     * @var string the id of the guild (may be missing for some channel objects received over gateway guild dispatches)
     */
    private string $guild_id;
    /**
     * @var int sorting position of the channel
     * @ORM\Column(type="int")
     */
    private int $position;
    /**
     * @var Collection<PermissionOverwrite> of overwrite objects explicit permission overwrites for members and roles
     * @ORM\ManyToOne(targetEntity="App\Entity\Discord\PermissionOverwrite", inversedBy="id")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private Collection $permission_overwrites;
    /**
     * @var string the name of the channel (1-100 characters)
     * @ORM\Column(type="string")
     */
    private string $name;
    /**
     * @var string the channel topic (0-1024 characters) [optional]
     * @ORM\Column(type="string")
     */
    private string $topic;
    /**
     * @var bool whether the channel is nsfw
     * @ORM\Column(type="boolean")
     */
    private bool $nsfw = false;
    /**
     * @see Snowflake
     * @var string the id of the last message sent in this channel (may not point to an existing or valid message)
     * @ORM\Column(type="string")
     */
    private string $last_message_id;
    /**
     * @var int the bitrate (in bits) of the voice channel
     * @ORM\Column(type="integer")
     */
    private int $bitrate;
    /**
     * @var int the user limit of the voice channel
     * @ORM\Column(type="integer")
     */
    private int $user_limit;
    /**
     * @var int amount of seconds a user has to wait before sending another message (0-21600); bots, as well as users with the permission manage_messages or manage_channel, are unaffected
     * @ORM\Column(type="integer")
     */
    private int $rate_limit_per_user;
    /**
     * @var array of user objects the recipients of the DM
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="id")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private array $recipients;
    /**
     * @var string icon hash of the group DM  [optional]
     * @ORM\Column(type="string")
     */
    private string $icon;
    /**
     * @var User id of the creator of the group DM or thread
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private User $owner_id;
    /**
     * @see Snowflake
     * @var string application id of the group DM creator if it is bot-created
     * @ORM\Column(type="string")
     */
    private string $application_id;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Discord\Channel", inversedBy="id")
     * @ORM\JoinColumn(referencedColumnName="id")
     * @var Channel for guild channels: id of the parent category for a channel (each parent category can contain up to 50 channels), for threads: id of the text channel this thread was created  [optional]
     */
    private Channel $parent_id;
    /**
     * @var \DateTime ?ISO8601 timestamp when the last pinned message was pinned. This may be null in events such as GUILD_CREATE when a message is not pinned.
     * @ORM\Column(type="datetime")
     */
    private \DateTime $last_pin_timestamp;
    /**
     * @var string voice region id for the voice channel, automatic when set to null [optional]
     * @ORM\Column(type="string")
     */
    private string $rtc_region;
    /**
     * @var int the camera video quality mode of the voice channel, 1 when not present
     * @ORM\Column(type="integer")
     */
    private int $video_quality_mode;
    /**
     * @var int an approximate count of messages in a thread, stops counting at 50
     * @ORM\Column(type="integer")
     */
    private int $message_count;
    /**
     * @var int an approximate count of users in a thread, stops counting at 50
     * @ORM\Column(type="integer")
     */
    private int $member_count;
    /**
     * @var ThreadMetaData a thread metadata object thread-specific fields not needed by other channels
     * @ORM\Column(type="object")
     */
    private ThreadMetaData $thread_metadata;
    /**
     * @var ThreadMember object for the current user, if they have joined the thread, only included on certain API endpoints
     * @ORM\Column(type="object")
     */
    private ThreadMember $member;
    /**
     * @var int default duration that the clients (not the API) will use for newly created threads, in minutes, to automatically archive the thread after recent activity, can be set to: 60, 1440, 4320, 10080
     * @ORM\Column(type="integer")
     */
    private int $default_auto_archive_duration;
    /**
     * @var string computed permissions for the invoking user in the channel, including overwrites, only included when part of the resolved data received on a slash command interaction
     * @ORM\Column(type="string")
     */
    private string $permissions;
}
