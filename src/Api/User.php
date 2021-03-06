<?php

namespace CallOfDuty\Api;

use CallOfDuty\Client;

use CallofDuty\Game\BlackOps4;

class User extends AbstractApi
{
    private $gamertag;
    private $platform;

    public function __construct(Client $client, string $gamertag, string $platform)
    {
        parent::__construct($client);
        $this->gamertag = $gamertag;
        $this->platform = $platform;
    }

    public function platform()
    {
        return $this->platform;
    }

    public function gamertag()
    {
        return $this->gamertag;
    }

    public function bo4() : GameInterface
    {
        return new BlackOps4($this->client, $this);
    }
}
