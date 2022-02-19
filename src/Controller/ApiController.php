<?php

namespace App\Controller;

use App\Services\DiscordService;
use Discord\InteractionResponseType;
use Discord\InteractionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ApiController extends AbstractController
{
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
            return match ($content->type) {
                InteractionType::APPLICATION_COMMAND => new JsonResponse(
                    [
                        'type' => InteractionResponseType::CHANNEL_MESSAGE_WITH_SOURCE,
                        "data" => [
                            'content' => 'APPLICATION_COMMAND => ' . json_encode($content->data),
                            "tts" => False,
                            "embeds" => [],
                            "allowed_mentions" => [
                                "parse" => []
                            ]
                        ]
                    ], 200),
                InteractionType::MESSAGE_COMPONENT => new JsonResponse(
                    [
                        'type' => InteractionResponseType::CHANNEL_MESSAGE_WITH_SOURCE,
                        "data" => [
                            'content' => 'MESSAGE_COMPONENT',
                            "tts" => False,
                            "embeds" => [],
                            "allowed_mentions" => [
                                "parse" => []
                            ]
                        ]
                    ], 200),
                InteractionType::APPLICATION_COMMAND_AUTOCOMPLETE => new JsonResponse(
                    [
                        'type' => InteractionResponseType::CHANNEL_MESSAGE_WITH_SOURCE,
                        "data" => [
                            'content' => 'APPLICATION_COMMAND_AUTOCOMPLETE',
                            "tts" => False,
                            "embeds" => [],
                            "allowed_mentions" => [
                                "parse" => []
                            ]
                        ]
                    ], 200),
                InteractionType::MODAL_SUBMIT => new JsonResponse(
                    [
                        'type' => InteractionResponseType::CHANNEL_MESSAGE_WITH_SOURCE,
                        "data" => [
                            'content' => 'MODAL_SUBMIT',
                            "tts" => False,
                            "embeds" => [],
                            "allowed_mentions" => [
                                "parse" => []
                            ]
                        ]
                    ], 200),
                default => new JsonResponse(['type' => InteractionResponseType::PONG], 200),
            };

        } else {
            return new JsonResponse(["type" => "not verified"], 401);
        }
    }

    /**
     * @Route ("/api/createCommand")
     * @throws TransportExceptionInterface
     */
    public function createCommand(Request $request, DiscordService $discordService): Response
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
     */
    public function oAuth(Request $request)
    {
        $oAuthCode = $request->get('code');
        $grantedPermissions = $request->get('permissions');
        $guildId = $request->get('guild_id');

        // TODO: create registered Instance Entity
        ob_start();
        echo '<h1>In Future, you get a user account to manage your Hermodur instance</h1>';
        dump([$oAuthCode, $guildId,$grantedPermissions]);
        $debug_dump = ob_get_clean();
        return new Response($debug_dump);
    }
}
