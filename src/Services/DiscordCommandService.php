<?php

namespace App\Services;

use App\Entity\ApplicationCommand;
use App\Entity\Discord\Guild;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;

class DiscordCommandService
{

    private EntityManager $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function resolve(string $guildId, string $command = null): array
    {
        /**
         * @var ApplicationCommand[]
         */
        $commands = $this->em->getRepository(Guild::class)->findOneBy(["guild_id" => $guildId])->getCommands();
        if (!empty($command)) {
            $commands = array_filter($commands, function ($item) use ($command) {
                return $item->getName() === $command;
            });
        }
        return $commands;
    }

    public function create()
    {

    }

    public function delete()
    {

    }

    /**
     * @param ApplicationCommand $command
     * @return JsonResponse
     */
    public function execute(ApplicationCommand $command): JsonResponse
    {
        return new JsonResponse(
            [
                "type" => $command->getType(),
                "data" => [
                    'content' => $command->getContent(),
                    "tts" => $command->getTts(),
                    "embeds" => $command->getEmbeds(),
                    "allowed_mentions" => $command->getAllowedMentions()
                ]
            ], 200);
    }

}
