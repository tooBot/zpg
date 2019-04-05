<?php

namespace core;

class HeroRepository
{
    const TBL_MAIN = 'heroes';

    private $heroId;
    private $db;
    private $connection;

    public function __construct($heroId)
    {
        $this->db = new Connection();
        $this->connection = $this->db->getConnection();

        $this->heroId = $heroId;
    }

    public function getHeroData()
    {
        return $this->connection
            ->table(self::TBL_MAIN)
            ->where('h_id', $this->heroId)
            ->get();
    }

    public function saveHeroData($data)
    {

    }

    public function setHeroName($heroName)
    {
        $heroData = $this->getHeroData();

        if (!$heroData['h_name']) {
            $this->connection
                ->table(self::TBL_MAIN)
                ->where('h_id', $this->heroId)
                ->update([
                    'h_name' => $heroName
                ]);

            return true;
        }

        return false;
    }
}