<?php

declare(strict_types=1);

namespace Daniil\OctoBundle\Enum;
/**
 * Class PaymentStatus
 *
 * Статус оплаты.
 *
 * @package Daniil\OctoBundle\Enum
 */
enum PaymentStatus: string
{
    /** Платеж успешно выполнен. */
    case SUCCEEDED = 'succeeded';
    /** Платеж создан/ */
    case CREATED = 'created';
    /** Платеж отменен. */
    case CANCELED = 'canceled';
    /** Ожидает действий пользователя. */
    case WAIT_USER_ACTION = 'wait_user_action';
    /** Платеж авторизован и ожидает подтверждения магазином. */
    case WAITING_FOR_CAPTURE = 'waiting_for_capture';
}
