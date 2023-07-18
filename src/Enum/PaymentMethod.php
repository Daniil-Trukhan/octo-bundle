<?php

declare(strict_types=1);

namespace Daniil\OctoBundle\Enum;

/**
 * Class PaymentMethod
 *
 * Метод оплаты.
 *
 * @package Daniil\OctoBundle\Enum
 */
enum PaymentMethod: string
{
    case UZCARD = 'uzcard';
    case HUMO = 'humo';
    case BANK_CARD = 'bank_card';
}
