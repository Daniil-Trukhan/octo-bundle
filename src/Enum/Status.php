<?php

declare(strict_types=1);

namespace Daniil\OctoBundle\Enum;

/**
 * Class Status
 *
 * Статус данного платежа в системе Octo
 *
 * @package Daniil\OctoBundle\Enum
 */
enum Status: string
{
    /** Платеж создан.  */
    case CREATED = 'created';
    /** Платеж отменен.  */
    case CANCELED = 'canceled';
    /** Платеж ожидает действий пользователя.  */
    case WAIT_USER_ACTION = 'wait_user_action';
    /** Платеж авторизован и ожидает подтверждения магазином.  */
    case WAITING_FOR_CAPTURE = 'waiting_for_capture';// -
    /** Платеж успешно выполнен.  */
    case SUCCEEDED = 'succeeded';
}
