<?php

namespace CallOfDuty\Api;

use CallOfDuty\Client;

class Squad extends AbstractApi 
{
    const ENDPOINT = 'https://squads.callofduty.com/api/v1';

    private $info;
    private $name;

    public function __construct(Client $client, string $name) 
    {
        parent::__construct($client);
        $this->name = $name;
    }

    /**
     * Get squad information.
     *
     * @return object Squad information.
     */
    private function info() : object
    {
        if ($this->info === null) {
            $data = $this->get(sprintf("%s/squad/lookup/name/%s/", self::ENDPOINT, $this->name));
            if ($data->status !== "success") {
                throw new Exception($data->data);
            }

            $this->info = $data->data;
        }

        return $this->info;
    }

    /**
     * Get group id.
     *
     * @return integer Group Id.
     */
    public function id() : int
    {
        return $this->info()->id;
    }

    /**
     * Get group creation date.
     *
     * @return \DateTime Creation date.
     */
    public function createDate() : \DateTime
    {
        return new \DateTime($this->info()->createDate);
    }

    /**
     * Get group name.
     *
     * @return string Group name.
     */
    public function name() : string
    {
        return $this->info()->name;
    }

    /**
     * Get group description.
     *
     * @return string Group description.
     */
    public function description() : string
    {
        return $this->info()->description;
    }

    /**
     * Get group avatar URL.
     *
     * @return string Avatar URL.
     */
    public function avatarUrl() : string
    {
        return $this->info()->avatarUrl;
    }

    /**
     * Get group status.
     *
     * @return boolean Group closed?
     */
    public function closed() : bool
    {
        return $this->info()->closed;
    }

    /**
     * Get group points.
     * 
     * Type is still unknown so for now, it's a float.
     *
     * @return float Group points.
     */
    public function points() : float
    {
        return $this->info()->points;
    }

    /**
     * Get group members.
     *
     * @return array Array of Api\User.
     */
    public function members() : array
    {
        // TODO
    }

}

