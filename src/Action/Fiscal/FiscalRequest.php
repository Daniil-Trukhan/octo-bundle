<?php

declare(strict_types=1);

namespace Daniil\OctoBundle\Action\Fiscal;

/**
 * Class FiscalRequest
 *
 * @package Daniil\OctoBundle\Action\Fiscal
 */
final readonly class FiscalRequest
{
    public function __construct(private string $paymentUuid)
    {
    }

    public function toArray(): array
    {
        return ['payment_uuid' => $this->paymentUuid];
    }
}
