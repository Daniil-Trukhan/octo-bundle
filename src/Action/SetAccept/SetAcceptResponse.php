<?php

declare(strict_types=1);

namespace Daniil\OctoBundle\Action\SetAccept;

use Daniil\OctoBundle\Enum\PaymentError;
use Daniil\OctoBundle\Enum\PaymentStatus;

/**
 * Class SetAcceptResponse
 *
 * @package Daniil\OctoBundle\Action\SetAccept
 */
final class SetAcceptResponse
{
    private ?PaymentError $error;
    private string $octoPayUrl;
    private string $octoPaymentUuid;
    private string $shopTransactionId;
    private ?PaymentStatus $status;

    public function __construct(object $data)
    {
        $this->error = PaymentError::tryFrom($data->error);
        $this->status = PaymentStatus::tryFrom($data->status);
        $this->shopTransactionId = (string)$data->shop_transaction_id;
        $this->octoPaymentUuid = (string)$data->octo_payment_UUID;
        $this->octoPayUrl = (string)$data->octo_pay_url;
    }

    /**
     * @return PaymentError|null
     */
    public function getError(): ?PaymentError
    {
        return $this->error;
    }

    /**
     * @return string
     */
    public function getOctoPayUrl(): string
    {
        return $this->octoPayUrl;
    }

    /**
     * @return string
     */
    public function getOctoPaymentUuid(): string
    {
        return $this->octoPaymentUuid;
    }

    /**
     * @return string
     */
    public function getShopTransactionId(): string
    {
        return $this->shopTransactionId;
    }

    /**
     * @return PaymentStatus|null
     */
    public function getStatus(): ?PaymentStatus
    {
        return $this->status;
    }

}
