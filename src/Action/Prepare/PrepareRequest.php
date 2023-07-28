<?php
declare(strict_types=1);

namespace Daniil\OctoBundle\Action\Prepare;

use Daniil\OctoBundle\Enum\Currency;
use Daniil\OctoBundle\Enum\Language;

/**
 * Class PrepareRequest
 *
 * @package Daniil\OctoBundle\Request
 */
final readonly class PrepareRequest
{

    public function __construct(
        private string                   $shopTransactionId,
        private float                    $sum,
        private Currency                 $currency,
        private string                   $description,
        private ?ProductCollection       $products = null,
        private ?PaymentMethodCollection $paymentMethods = null,
        private ?UserData                $userData = null,
        private ?string                  $tag = null,
        private ?string                  $returnUrl = null,
        private ?string                  $tspId = null,
        private ?Language                $language = null,
    )
    {
    }

    public function toArray(): array
    {
        $result = [
            'shop_transaction_id' => $this->shopTransactionId,
            'init_time' => date('Y-m-d H:i:s'),
            'total_sum' => $this->sum,
            'currency' => $this->currency->value,
            'description' => $this->description,
            'ttl' => 15
        ];

        if ($this->tspId) {
            $result['tsp_id'] = $this->tspId;
        }

        if ($this->returnUrl) {
            $result['return_url'] = $this->returnUrl;
        }

        if ($this->products) {
            $result['basket'] = $this->products->toArray();
        }

        if ($this->paymentMethods) {
            $result['payment_methods'] = $this->paymentMethods->toArray();
        }

        if ($this->userData) {
            $result['user_data'] = $this->userData;
        }

        if ($this->tag) {
            $result['tag'] = $this->tag;
        }

        if ($this->language) {
            $result['language'] = $this->language->value;
        }

        return $result;
    }
}
