<?php

namespace core;

class HeroRepository
{
    private $heroId;
    private $conneection;

    public function __construct($heroId)
    {
        $this->conneection = new DBConnection();

        $this->heroId = $heroId;
    }

    public function getHeroData()
    {
        $result = [];

        return $result;
    }

    public function saveHeroData($data)
    {

    }
}