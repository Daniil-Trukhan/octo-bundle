<?php

declare(strict_types=1);

namespace Daniil\OctoBundle\Enum;

/**
 * Class Currency
 *
 * Валюты
 *
 * @package Daniil\OctoBundle\Enum
 */
enum Currency: string
{
    /** Доллар США */
    case USD = 'USD';
    /** Сум */
    case UZS = 'UZS';

}
