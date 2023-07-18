<?php

declare(strict_types=1);

namespace Daniil\OctoBundle\Action\Prepare;

use Daniil\OctoBundle\Enum\PaymentMethod;
use Ramsey\Collection\Collection;

/**
 * Class PaymentMethodCollection
 *
 * Коллекция методов оплаты.
 *
 * @package Daniil\OctoBundle\Action\Prepare
 */
final class PaymentMethodCollection extends Collection
{
    public function __construct(array $data = [])
    {
        parent::__construct(PaymentMethod::class, $data);
    }
}
