<?php

declare(strict_types=1);

namespace Daniil\OctoBundle\Service;

use Daniil\OctoBundle\Action\Prepare\PrepareRequest;
use Daniil\OctoBundle\Action\Prepare\PrepareResponse;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class Client
 *
 * @package Daniil\OctoBundle\Service
 */
final class Client
{
    private array $config;
    private const PREPARE_URL = 'https://secure.octo.uz/prepare_payment';


    public function __construct(private readonly HttpClientInterface $client, ParameterBagInterface $config)
    {
       $this->config = [
            'test' => $config->get('octo.test'),
            'octo_shop_id' => $config->get('octo.shop_id'),
            'octo_secret' => $config->get('octo.secret'),
            'auto_capture' => $config->get('octo.auto_capture'),
       ];
    }

    /**
     * @param PrepareRequest $request
     * @return PrepareResponse
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function prepare(PrepareRequest $request): PrepareResponse
    {
        $requestData = array_merge($request->toArray(), $this->config);
        $response = $this->client->request('POST', self::PREPARE_URL, $requestData);
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new ClientException($response);
        }
        return new PrepareResponse(json_decode($response->getContent()));
    }
}
