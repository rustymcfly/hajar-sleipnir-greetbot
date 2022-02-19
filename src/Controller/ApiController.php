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
use Symfony\Contracts\HttpClient\ResponseInterface;

class ApiController extends AbstractController
{
    /**
     * @Route ("/api")
     */
    public function interactions(Request $request, DiscordService $discordService): JsonResponse
    {
        file_put_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . time() . '.json', $request->getContent());

        $authenticated = $discordService->authenticate($request);

        if ($authenticated) {
            $content = json_decode($request->getContent());

            switch ($content->type) {
                case InteractionType::PING:
                    return new JsonResponse(['type' => InteractionResponseType::PONG], 200);
                    break;
                case InteractionType::APPLICATION_COMMAND:
                    break;
                case InteractionType::MESSAGE_COMPONENT:
                    break;
                case InteractionType::APPLICATION_COMMAND_AUTOCOMPLETE:
                    break;
                case InteractionType::MODAL_SUBMIT:
                    break;
                default:
                    return new JsonResponse(['type' => InteractionResponseType::PONG], 200);
            }

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
        return new Response($discordService->createCommand("", "", "", [])->getContent());
    }


    /**
     * @Route ("/api/createCommand")
     * @param Request $request
     */
    public function oAuth (Request $request) {

    }

    /**
     * @Route ("/api/log")
     */
    public function log(Request $request)
    {

        dump($request);
        file_put_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . time() . '.json', json_encode($request->getContent()));
        dump($request);
        die();
    }
}
