<?php

namespace App\Controller;

use App\Entity\Discord\Guild;
use App\Services\DiscordService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(name="account", path="/account")
 */
class AccountController extends AbstractController
{

    private EntityManagerInterface $entityManager;
    private DiscordService $discordService;

    public function __construct(DiscordService $discordService, EntityManagerInterface $entityManager)
    {
        $this->discordService = $discordService;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route(name="_index", path="/")
     */
    public function index(Request $request)
    {

    }

    /**
     * @Route(name="_edit", path="/edit")
     */
    public function edit(Request $request)
    {
        $guild = $this->entityManager->getRepository(Guild::class)->findByGuildId($request->get('guild_id'));
        $token = $request->get('auth_code');
        $discord_guild = json_decode($this->discordService->getGuild($guild)->getContent());
        return $this->render('Account/edit.html.twig', [
            "discord_app_id" => $this->getParameter('discord_application_id'),
            "guild" => $guild,
            "discord_guild" => $discord_guild,
            "token" => $token
        ]);
    }

    /**
     * @Route(name="_guilds", path="/guilds")
     */
    public function guilds(Request $request)
    {

    }
}
