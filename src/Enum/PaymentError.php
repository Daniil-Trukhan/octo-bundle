<?php
declare(strict_types=1);

namespace Daniil\OctoBundle\Enum;

/**
 * Class PaymentError
 *
 * Код ошибки
 *
 * @package Daniil\OctoBundle\Enum
 */
enum PaymentError: int
{
    /** Нет ошибок.  */
    case NO_ERRORS = 0;
    /** Ошибка формата данных.  */
    case FORMAT_ERROR = 1;
    /** Ошибка авторизации.  */
    case AUTH_ERROR = 2;
    /** Внутренняя ошибка сервиса.  */
    case SERVER_ERROR = 4;
    /** Не удалось сменить статус платежа.  */
    case CHANGE_STATUS_ERROR = 10;
    /** Платеж с указанным octo_payment_UUID не найден.  */
    case NOT_FOUND_ERROR = 11;
}
