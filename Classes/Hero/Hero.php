<?php

namespace core;

class Hero
{
    private $heroId;
    private $heroData;

    private $repository;

    public function __construct($heroId)
    {
        $this->heroId = $heroId;

        $this->repository = new HeroRepository($this->heroId);
        $this->heroData = $this->repository->getHeroData();
    }

}