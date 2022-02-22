<?php

namespace App\Entity;

use App\Entity\Discord\Guild;
use App\Services\DiscordCommandService;
use App\Repository\ApplicationCommandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 *
 * @ORM\Entity(repositoryClass=ApplicationCommandRepository::class)
 * @ORM\Table(name="application_command")
 */
class ApplicationCommand implements Interaction
{

    const PONG = 1;
    const CHANNEL_MESSAGE_WITH_SOURCE = 4;
    const DEFERRED_CHANNEL_MESSAGE_WITH_SOURCE = 5;
    const DEFERRED_UPDATE_MESSAGE = 6;
    const UPDATE_MESSAGE = 7;
    const APPLICATION_COMMAND_AUTOCOMPLETE_RESULT = 8;
    const MODAL = 9;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected int $id;
    /**
     * @ORM\Column(type="string")
     */
    protected string $name;

    /**
     * @ORM\Column(type="integer")
     */
    protected int $type;

    /**
     * @ORM\ManyToOne (targetEntity="App\Entity\Discord\Guild", inversedBy="commands")
     */
    protected Guild $guild;
    /**
     * @var DiscordCommandService
     */
    private DiscordCommandService $commandService;
    /**
     * @var ArrayCollection
     */
    private ArrayCollection $allowedMentions;
    /**
     * @var bool
     */
    private bool $tts;
    /**
     * @var string
     */
    private string $content;
    /**
     * @var ArrayCollection
     */
    private ArrayCollection $embeds;

    /**
     * @param DiscordCommandService $commandService
     */
    #[Pure] public function __construct(DiscordCommandService $commandService)
    {
        $this->commandService = $commandService;
        $this->guilds = new ArrayCollection();
        $this->allowedMentions = new ArrayCollection();
        $this->embeds = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function execute(): JsonResponse
    {
        return $this->commandService->execute($this);
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }

    /**
     * @return ArrayCollection
     */
    public function getAllowedMentions(): ArrayCollection
    {
        return $this->allowedMentions;
    }

    /**
     * @param ArrayCollection $allowedMentions
     */
    public function setAllowedMentions(ArrayCollection $allowedMentions): void
    {
        $this->allowedMentions = $allowedMentions;
    }

    /**
     * @return bool
     */
    public function getTts(): bool
    {
        return $this->tts;
    }

    /**
     * @param bool $tts
     */
    public function setTts(bool $tts): void
    {
        $this->tts = $tts;
    }


    /**
     * @return ArrayCollection
     */
    public function getEmbeds(): ArrayCollection
    {
        return $this->embeds;
    }

    /**
     * @param ArrayCollection $embeds
     */
    public function setEmbeds(ArrayCollection $embeds): void
    {
        $this->embeds = $embeds;
    }


    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return Guild
     */
    public function getGuild(): Guild
    {
        return $this->guild;
    }

    /**
     * @param Guild $guild
     */
    public function setGuild(Guild $guild): void
    {
        $this->guild = $guild;
    }

}
