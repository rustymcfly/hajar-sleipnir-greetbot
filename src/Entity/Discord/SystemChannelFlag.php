<?php

namespace App\Entity\Discord;

class SystemChannelFlag
{
    /**
     * Suppress member join notifications
     */
    const  SUPPRESS_JOIN_NOTIFICATIONS = 0;
    /**
     * Suppress server boost notifications
     */
    const  SUPPRESS_PREMIUM_SUBSCRIPTIONS = 1;
    /**
     * Suppress server setup tips
     */
    const  SUPPRESS_GUILD_REMINDER_NOTIFICATIONS = 2;
    /**
     * Hide member join sticker reply buttons
     */
    const  SUPPRESS_JOIN_NOTIFICATION_REPLIES = 3;
}
