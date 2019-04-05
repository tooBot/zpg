<?php

namespace Core\Battle;

/*
 * Класс боев
 *
 * Каждые 10 минут кроном запускаются бои
 * Выбираются все персонажи, сортируются в порядке убывания силы персонажа
 * Сила персонажа = сила * 0,75 + удача * 1,2 + ловкость * 0,88 + здоровье * 2)
 * Далее, начиная с самого сильного, берется противник, который стоит ниже на 1 поизицию и проводится бой
 *
 * ***БОЙ***
 * Каждые 10 секунд рассчитывается раунд, пока кто-то есть живой
 * Каждый раунд персонажи бьют друг-друга.
 * Проверяется урон, шанс увернуться, шанс нанести критический урон.
 *
 * ***БОЕВЫЕ ФОРМУЛЫ***
 * Урон = случайное округленное число в диапазоне от минимального до максимального урона.
 * Минимальный урон = ловкость + удача * 0,5
 * Максимальный урон = сила + ловкость * 0,5 + удача * 0,75
 * Если минимальный урон больше максимального - меняем местами
 *
 * Здоровье персонажа = уровень_персонажа ^ 2 + (уровень персонажа + 1) * 5
 *
 * Шанс увернутся от удара = ловкость ^ 2 - удача противника ^ 2.
 * Если шанс увернуться меньше 10%  - он равен 10%
 *
 * Шанс критического удара = удача персонажа ^ 2 - здоровье противника ^ 2 - удача противника
 * Если шанс критического удара меньше 10% - он равен 10%
 *
 */

use core\Config;

class Battle
{
    const WIN_EXP = 10;
    const LOSE_EXP = 5;
    const DRAW_EXP = 7;

    const MIN_MISS_CHANCE = 10;
    const MIN_KRIT_CHANCE = 10;


    private $config;

    public function __construct()
    {
        $this->config = new Config();
    }

    public function getHeroDamage($heroData)
    {
        $min = round($heroData['h_dex'] + $heroData['h_luck'] * 0.5);
        $max = round($heroData['h_str'] + $heroData['h_dex'] * 0.5 + $heroData['h_luck'] * 0.75);

        if ($min > $max) {
            $temp = $max;
            $max = $min;
            $min = $temp;
        }

        return mt_rand($min, $max);
    }

    public function getHeroHP($heroData)
    {
        return pow($heroData['h_level'], 2) + ($heroData['h_level'] + 1) * 5;
    }

    public function getHeroMissChance($heroData, $enemyData)
    {
        $chance = pow($heroData['h_dex'], 2) - pow($enemyData['h_luck'], 2);

        if ($chance < self::MIN_MISS_CHANCE) {
            $chance = self::MIN_MISS_CHANCE;
        }

        return $chance;
    }

    public function getHeroKritChance($heroData, $enemyData)
    {
        $chance = pow($heroData['h_luck'], 2) - pow($enemyData['h_health'], 2) - $enemyData['h_luck'];

        if ($chance < self::MIN_KRIT_CHANCE) {
            $chance = self::MIN_KRIT_CHANCE;
        }

        return $chance;
    }
}