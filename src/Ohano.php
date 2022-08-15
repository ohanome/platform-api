<?php

namespace App;

class Ohano
{
    const PRICING_PLUS_FACTOR = 1.5;
    const PRICING_FLEX_FACTOR = 10;

    const PRICE_BASIC = 5;
    const PRICE_ADVANCED = 10;
    const PRICE_PRO = 25;
    const PRICE_GOLD = self::PRICE_ADVANCED * self::PRICING_FLEX_FACTOR;
    const PRICE_DIAMOND = self::PRICE_PRO * self::PRICING_PLUS_FACTOR;
    const PRICE_BASIC_PLUS = self::PRICE_BASIC * self::PRICING_PLUS_FACTOR;
    const PRICE_ADVANCED_PLUS = self::PRICE_ADVANCED * self::PRICING_PLUS_FACTOR;
    const PRICE_PRO_PLUS = self::PRICE_PRO * self::PRICING_PLUS_FACTOR;
    const PRICE_GOLD_PLUS = self::PRICE_GOLD * self::PRICING_PLUS_FACTOR;
    const PRICE_DIAMOND_PLUS = self::PRICE_DIAMOND * self::PRICING_PLUS_FACTOR;
}