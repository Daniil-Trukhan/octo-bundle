<?php

declare(strict_types=1);

namespace Daniil\OctoBundle\Service;

use Daniil\OctoBundle\Action\Fiscal\FiscalRequest;
use Daniil\OctoBundle\Action\Fiscal\FiscalResponse;
use Daniil\OctoBundle\Action\Notify\SetAcceptRequest;
use Daniil\OctoBundle\Action\Notify\SetAcceptResponse;
use Daniil\OctoBundle\Action\Prepare\PrepareRequest;
use Daniil\OctoBundle\Action\Prepare\PrepareResponse;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class Client
 *
 * @package Daniil\OctoBundle\Service
 */
final class Client
{
    private const PREPARE_URL = 'https://secure.octo.uz/prepare_payment';
    private const FISCAL_URL = 'https://secure.octo.uz/fiscal-data';
    private const SET_ACCEPT_URL = 'https://secure.octo.uz/set_accept';

    private bool $autoCapture;
    private string $notifyUrl;
    private bool $octoSecret;
    private bool $octoShopId;
    private string $returnUrl;
    private bool $test;

    public function __construct(private readonly HttpClientInterface $client, ParameterBagInterface $config)
    {
        $this->test = (bool)$config->get('octo.test');
        $this->octoShopId = $config->get('octo.shop_id');
        $this->octoSecret = $config->get('octo.secret');
        $this->autoCapture = (bool)$config->get('octo.auto_capture');
        $this->returnUrl = $config->get('octo.return_url');
        $this->notifyUrl = $config->get('octo.notify_url');
    }

    /** Фискализация. */
    public function fiscal(FiscalRequest $request): FiscalResponse
    {
        $requestData = array_merge($request->toArray(), [
            'octo_shop_id' => $this->octoShopId,
            'octo_secret' => $this->octoSecret
        ]);
        $response = $this->client->request('POST', self::FISCAL_URL, $requestData);
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new ClientException($response);
        }
        return new FiscalResponse(json_decode($response->getContent()));
    }

    /** Формирование корзины и создание платежа. */
    public function prepare(PrepareRequest $request): PrepareResponse
    {
        $requestData = array_merge($request->toArray(), [
            'test' => $this->test,
            'octo_shop_id' => $this->octoShopId,
            'auto_capture' => $this->autoCapture,
            'octo_secret' => $this->octoSecret,
            'return_url' => $this->returnUrl,
            'notify_url' => $this->notifyUrl
        ]);
        $response = $this->client->request('POST', self::PREPARE_URL, $requestData);
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new ClientException($response);
        }
        return new PrepareResponse(json_decode($response->getContent()));
    }

    /** Подтверждение или отмена платежа. */
    public function setAccept(SetAcceptRequest $request): SetAcceptResponse
    {
        $requestData = array_merge($request->toArray(), [
            'octo_shop_id' => $this->octoShopId,
            'octo_secret' => $this->octoSecret
        ]);
        $response = $this->client->request('POST', self::SET_ACCEPT_URL, $requestData);
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new ClientException($response);
        }
        return new SetAcceptResponse(json_decode($response->getContent()));
    }
}
