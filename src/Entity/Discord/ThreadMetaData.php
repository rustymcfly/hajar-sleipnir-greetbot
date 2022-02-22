<?php

namespace App\Entity\Discord;

class ThreadMetaData
{
    /**
     * @var bool whether the thread is archived
     */
    private bool $archived;
    /**
     * @var int duration in minutes to automatically archive the thread after recent activity, can be set to: 60, 1440, 4320, 10080
     */
    private int $auto_archive_duration;
    /**
     * @var \DateTime ISO8601 timestamp    timestamp when the thread's archive status was last changed, used for calculating recent activity
     */
    private \DateTime $archive_timestamp;
    /**
     * @var bool whether the thread is locked; when a thread is locked, only users with MANAGE_THREADS can unarchive it
     */
    private bool $locked;
    /**
     * @var bool whether non-moderators can add other non-moderators to a thread; only available on private threads [optional]
     */
    private bool $invitable;
    /**
     * @var \DateTime ISO8601 timestamp    timestamp when the thread was created; only populated for threads created after 2022-01-09 [optional]
     */
    private \DateTime $create_timestamp;
}
