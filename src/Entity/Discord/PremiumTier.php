<?php

namespace App\Entity\Discord;

class PremiumTier
{
    /**
     * guild has not unlocked any Server Boost perks
     */
    const  NONE = 0;
    /**
     * guild has unlocked Server Boost level 1 perks
     */
    const  TIER_1 = 1;
    /**
     * guild has unlocked Server Boost level 2 perks
     */
    const  TIER_2 = 2;
    /**
     * guild has unlocked Server Boost level 3 perks
     */
    const  TIER_3 = 3;
}
