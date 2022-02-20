<?php

namespace App\Services;

use Discord\Interaction;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class DiscordService
{
    private string $secret;
    private string $bot_token;
    private string $application_id;
    private ContainerInterface $container;
    private HttpClientInterface $client;

    public function __construct(ContainerInterface $container, HttpClientInterface $client)
    {

        $this->container = $container;
        $this->secret = $container->getParameter('discord_secret');
        $this->bot_token = $container->getParameter('discord_bot_token');
        $this->application_id = $container->getParameter('discord_application_id');

        $this->client = $client;
    }

    public function authenticate(Request $request)
    {
        $signature = $request->headers->get('x-signature-ed25519');
        $timestamp = $request->headers->get('x-signature-timestamp');

        file_put_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . time() . '.json', $request->getContent());

        $postData = $request->getContent();
        return Interaction::verifyKey($postData, $signature, $timestamp, $this->secret);
    }

    /**
     * @param string $name
     * @param $type
     * @param $description
     * @param $options
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    public function createCommand($name, $type, $description, $options): ResponseInterface
    {
        $json = [
            "name" => $name,
            "description" => $description,
            "options" => [
                [
                    "name" => "animal",
                    "description" => "The type of animal",
                    "type" => 3,
                    "required" => True,
                    "choices" => [
                        [
                            "name" => "Dog",
                            "value" => "animal_dog"
                        ],
                        [
                            "name" => "Cat",
                            "value" => "animal_cat"
                        ],
                        [
                            "name" => "Penguin",
                            "value" => "animal_penguin"
                        ]
                    ]
                ],
                [
                    "name" => "only_smol",
                    "description" => "Whether to show only baby animals",
                    "type" => 5,
                    "required" => False
                ]
            ]
        ];
        return $this->client->request(
            'POST',
            'https://discordapp.com/api/v8/applications/' . $this->application_id . '/commands',
            [
                'json' => $json
            ]
        );
    }
}
