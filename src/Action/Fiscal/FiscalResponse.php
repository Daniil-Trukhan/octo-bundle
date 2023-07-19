<?php

declare(strict_types=1);

namespace Daniil\OctoBundle\Action\Fiscal;

use JsonSerializable;

/**
 * Class FiscalResponse
 *
 * @package Daniil\OctoBundle\Action\Fiscal
 */
final class FiscalResponse implements JsonSerializable
{
    private FiscalData $data;
    private string $errMessage;
    private int $error;

    public function __construct(object $data)
    {
        $this->error = (int)$data->error;
        $this->errMessage = (string)$data->errMessage;
        $this->data = new FiscalData($data->data);
    }

    public function jsonSerialize(): array
    {
        return [
            'error' => $this->error,
            'errMessage' => $this->errMessage,
            'data' => $this->data
        ];
    }
}
