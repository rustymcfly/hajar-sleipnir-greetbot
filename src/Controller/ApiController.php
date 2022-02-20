<?php

namespace App\Controller;

use App\Entity\ApplicationCommand;
use App\Entity\Discord\Guild;
use App\Services\DiscordService;
use Discord\InteractionResponseType;
use Discord\InteractionType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route ("/api")
     */
    public function interactions(Request $request, DiscordService $discordService): JsonResponse
    {
        // log the interactions in the file system for now...
        file_put_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . time() . '.json', $request->getContent());

        $authenticated = $discordService->authenticate($request);

        if ($authenticated) {
            $content = json_decode($request->getContent());
            // TODO: Create Responses, Embeds, Modals as Classes

            $command = $this->entityManager->getRepository(ApplicationCommand::class)->findByNameAndGuildId($content->data->name, $content->guild_id);
            if ($command)
                return $command->execute();
            else {
                return new JsonResponse(['type' => InteractionResponseType::PONG], 200);
            }
        } else {
            return new JsonResponse(["type" => "not verified"], 401);
        }
    }

    /**
     * @Route ("/api/createCommand")
     */
    public function createCommand(/*Request $request, DiscordService $discordService*/): Response
    {

        // Todo: create default commands
        // Todo: create Command Entity and assign it to the guildId of user
        // Todo: create Fronted Form for creating commands
//        $response = $discordService->createCommand("", "", "", []);
//        return new Response($response->getContent(), $response->getStatusCode(), $response->getHeaders());
        return new Response('not allowed', 401);
    }


    /**
     * @Route ("/api/oAuth")
     * @param Request $request
     * @return Response
     */
    public function oAuth(Request $request): Response
    {
        $oAuthCode = $request->get('code');
        $grantedPermissions = $request->get('permissions');
        $guildId = $request->get('guild_id');

        // TODO: create registered Instance Entity
        ob_start();
        echo '<h1>In Future, you get a user account to manage your Hermodur instance</h1>';
        dump([$oAuthCode, $guildId, $grantedPermissions]);
        $debug_dump = ob_get_clean();
        return new Response($debug_dump);
    }

}
