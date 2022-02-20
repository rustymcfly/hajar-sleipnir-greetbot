<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\JsonResponse;

interface Interaction
{
    public function execute (): JsonResponse;
}
