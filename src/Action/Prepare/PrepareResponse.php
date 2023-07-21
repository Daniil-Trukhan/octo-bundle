<?php
declare(strict_types=1);

namespace Daniil\OctoBundle\Action\Prepare;

use Daniil\OctoBundle\Enum\Error;
use Daniil\OctoBundle\Enum\Status;

/**
 * Class PrepareResponse
 *
 * @package Daniil\OctoBundle\Action\Prepare
 */
final class PrepareResponse
{
    /**  URL на который следует перенаправить покупателя для совершения платежа. */
    private Error $error;
    /**  Детальное описание ошибки. */
    private ?string $errorMessage;
    /**  URL на который следует перенаправить покупателя для совершения платежа. */
    private ?string $octoPayUrl;
    /**  Уникальный идентификатор транзакции в ПС Octo. */
    private ?string $octoPaymentUuid;
    /**  Возвращенная покупателю сумма. */
    private ?string $refundedSum;
    /** Уникальный идентификатор транзакции на стороне магазина. */
    private ?string $shopTransactionId;
    /** Статус данного платежа в системе Octo. */
    private Status $status;
    /**  Сумма по счету за вычетом комиссии Octo, доступная для возврата средств покупателю. */
    private ?string $transferSum;

    public function __construct(object $data)
    {
        $this->status = Status::tryFrom($data->status);
        $this->shopTransactionId = $data->shop_transaction_id;
        $this->octoPaymentUuid = $data->octo_payment_UUID;
        $this->octoPayUrl = $data->octo_pay_url;
        $this->error = Error::tryFrom($data->error);
        $this->errorMessage = property_exists($data, 'errorMessage') ? $data->errorMessage : null;
        $this->transferSum = property_exists($data, 'transfer_sum') ? $data->transfer_sum : null;
        $this->refundedSum = property_exists($data, 'refunded_sum') ? $data->refunded_sum : null;
    }

    /**
     * @return Error
     */
    public function getError(): Error
    {
        return $this->error;
    }

    /**
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    /**
     * @return string|null
     */
    public function getOctoPayUrl(): ?string
    {
        return $this->octoPayUrl;
    }

    /**
     * @return string|null
     */
    public function getOctoPaymentUuid(): ?string
    {
        return $this->octoPaymentUuid;
    }

    /**
     * @return string|null
     */
    public function getRefundedSum(): ?string
    {
        return $this->refundedSum;
    }

    /**
     * @return string|null
     */
    public function getShopTransactionId(): ?string
    {
        return $this->shopTransactionId;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getTransferSum(): ?string
    {
        return $this->transferSum;
    }
}
