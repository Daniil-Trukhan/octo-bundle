<?php

declare(strict_types=1);

namespace Daniil\OctoBundle\Service;

use Daniil\OctoBundle\Action\Fiscal\FiscalRequest;
use Daniil\OctoBundle\Action\Fiscal\FiscalResponse;
use Daniil\OctoBundle\Action\SetAccept\SetAcceptRequest;
use Daniil\OctoBundle\Action\SetAccept\SetAcceptResponse;
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
    private string $octoSecret;
    private int $octoShopId;
    private bool $test;

    public function __construct(private readonly HttpClientInterface $client, ParameterBagInterface $config)
    {
        $this->test = (bool)$config->get('octo_test');
        $this->octoShopId = (int)$config->get('octo_shop_id');
        $this->octoSecret = $config->get('octo_secret');
        $this->autoCapture = (bool)$config->get('octo_auto_capture');
        $this->notifyUrl = $config->get('octo_notify_url');
    }

    /**
     * Фискализация.
     * @throws ClientException
     */
    public function fiscal(FiscalRequest $request): FiscalResponse
    {
        $requestData = array_merge($request->toArray(), [
            'octo_shop_id' => $this->octoShopId,
            'octo_secret' => $this->octoSecret
        ]);
        $response = $this->client->request('POST', self::FISCAL_URL, ['json' => $requestData]);
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new ClientException($response);
        }
        return new FiscalResponse(json_decode($response->getContent()));
    }

    /**
     * Формирование корзины и создание платежа.
     * @throws ClientException
     */
    public function prepare(PrepareRequest $request): PrepareResponse
    {
        $requestData = array_merge($request->toArray(), [
            'test' => $this->test,
            'octo_shop_id' => $this->octoShopId,
            'auto_capture' => $this->autoCapture,
            'octo_secret' => $this->octoSecret,
            'notify_url' => $this->notifyUrl
        ]);
        $response = $this->client->request('POST', self::PREPARE_URL, ['json' => $requestData]);
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new ClientException($response);
        }
        return new PrepareResponse(json_decode($response->getContent()));
    }

    /**
     * Подтверждение или отмена платежа.
     * @throws ClientException
     */
    public function setAccept(SetAcceptRequest $request): SetAcceptResponse
    {
        $requestData = array_merge($request->toArray(), [
            'octo_shop_id' => $this->octoShopId,
            'octo_secret' => $this->octoSecret
        ]);
        $response = $this->client->request('POST', self::SET_ACCEPT_URL, ['json' => $requestData]);
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new ClientException($response);
        }
        return new SetAcceptResponse(json_decode($response->getContent()));
    }
}
