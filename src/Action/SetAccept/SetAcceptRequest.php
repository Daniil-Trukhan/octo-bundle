<?php

declare(strict_types=1);

namespace Daniil\OctoBundle\Action\Notify;

use Daniil\OctoBundle\Enum\AcceptStatus;

/**
 * Class SetAcceptRequest
 *
 * @package Daniil\OctoBundle\Action\Notify
 */
final readonly class SetAcceptRequest
{

    public function __construct(
        private string       $octoPaymentUuid,
        private AcceptStatus $acceptStatus,
        private float        $finalAmount
    )
    {
    }

    public function toArray(): array
    {
        return [
            'octo_payment_UUID' => $this->octoPaymentUuid,
            'accept_status' => $this->acceptStatus->value,
            'final_amount' => $this->finalAmount
        ];
    }
}
