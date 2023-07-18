<?php

declare(strict_types=1);

namespace Daniil\OctoBundle\Enum;

/**
 * Class Language
 *
 * Язык платежной формы.
 *
 * @package Daniil\OctoBundle\Enum
 */
enum Language: string
{
    /** Узбекский, латиница */
    case OZ = 'oz';
    /** Узбекский, кириллица */
    case UZ = 'uz';
    /** Английский */
    case EN = 'en';
    /** Русский */
    case RU = 'ru';
}
