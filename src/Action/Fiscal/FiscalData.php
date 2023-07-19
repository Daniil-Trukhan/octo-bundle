<?php

declare(strict_types=1);

namespace Daniil\OctoBundle\Action\Fiscal;

use JsonSerializable;

/**
 * Class FiscalData
 *
 * @package Daniil\OctoBundle\Action\Fiscal
 */
final class FiscalData implements JsonSerializable
{
    private int $code;
    private string $dateTime;
    private string $fiscalSign;
    private string $message;
    private string $phone;
    private string $qrCodeURL;
    private int $receiptId;
    private string $terminalID;

    public function __construct(object $data)
    {
        $this->code = (int)$data->code;
        $this->dateTime = (string)$data->dateTime;
        $this->fiscalSign = (string)$data->fiscalSign;
        $this->message = (string)$data->message;
        $this->phone = (string)$data->phone;
        $this->qrCodeURL = (string)$data->qrCodeURL;
        $this->receiptId = (int)$data->receiptId;
        $this->terminalID = (string)$data->terminalID;
    }


    public function jsonSerialize(): array
    {
        return [
            'code' => $this->code,
            'dateTime' => $this->dateTime,
            'fiscalSign' => $this->fiscalSign,
            'message' => $this->message,
            'phone' => $this->phone,
            'qrCodeURL' => $this->qrCodeURL,
            'receiptId' => $this->receiptId,
            'terminalID' => $this->terminalID
        ];
    }
}
