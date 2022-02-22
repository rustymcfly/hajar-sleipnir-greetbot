<?php

namespace App\Entity\Discord;

class ChannelType
{
    /**
     * @var int a text channel within a server
     */
    const GUILD_TEXT = 0;
    /**
     * @var int a direct message between users
     */
    const DM = 1;
    /**
     * @var int a voice channel within a server
     */
    const GUILD_VOICE = 2;
    /**
     * @var int a direct message between multiple users
     */
    const GROUP_DM = 3;
    /**
     * @var int an organizational category that contains up to 50 channels
     */
    const GUILD_CATEGORY = 4;
    /**
     * @var int    a channel that users can follow and crosspost into their own server
     */
    const GUILD_NEWS = 5;
    /**
     * @var int a channel in which game developers can sell their game on Discord
     */
    const GUILD_STORE = 6;
    /**
     * @var int a temporary sub-channel within a GUILD_NEWS channel
     */
    const GUILD_NEWS_THREAD = 10;
    /**
     * @var int a temporary sub-channel within a GUILD_TEXT channel
     */
    const GUILD_PUBLIC_THREAD = 11;
    /**
     * @var int a temporary sub-channel within a GUILD_TEXT channel that is only viewable by those invited and those with the MANAGE_THREADS permission
     */
    const GUILD_PRIVATE_THREAD = 12;
    /**
     * @var int a voice channel for hosting events with an audience
     */
    const GUILD_STAGE_VOICE = 13;
}
