<?php
declare(strict_types=1);

namespace Daniil\OctoBundle\Action\Prepare;

use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class PrepareAction
 *
 * @package Daniil\OctoBundle\Action\Prepare
 */
final readonly class PrepareAction
{


    public function __construct(private HttpClientInterface $client)
    {
    }


    public function __invoke(PrepareRequest $request): PrepareResponse
    {
        $result = $this->client->request('POST', self::COMMON_API_URL, [

        ]);

        return new PrepareResponse(json_decode($result->getContent()));
    }

}
