<?php

declare(strict_types=1);

namespace Daniil\OctoBundle\Enum;

/**
 * Class AcceptStatus
 *
 * Class
 *
 * @package Daniil\OctoBundle\Enum
 */
enum AcceptStatus: string
{
    /** Подтвердить платеж */
    case CAPTURE = 'capture';
    /** Отменить платеж */
    case CANCEL = 'cancel';
}
