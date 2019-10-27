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

    public function getHeroData() : array
    {
        return $this->heroData;
    }

    public function getHeroId() : int
    {
        return $this->heroId;
    }

    public function setHeroName(string $heroName) : bool
    {
        return $this->repository->setHeroName($heroName);
    }

}