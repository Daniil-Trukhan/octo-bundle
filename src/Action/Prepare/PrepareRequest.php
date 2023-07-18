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
final class PrepareRequest
{


    public function __construct(
        private readonly string                   $shopTransactionId,
        private readonly float                    $sum,
        private readonly Currency                 $currency,
        private readonly string                   $description,
        private readonly ?ProductCollection       $products = null,
        private readonly ?PaymentMethodCollection $paymentMethods = null,
        private readonly ?UserData                $userData = null,
        private readonly ?string                  $tag = null,
        private readonly ?string                  $tspId = null,
        private readonly ?Language                $language = null,
    )
    {
    }

    public function toArray(): array
    {
        $result = [
            "shop_transaction_id" => $this->shopTransactionId,
            "init_time" => date('Y-m-d H:i:s'),
            "total_sum" => $this->sum,
            "currency" => $this->currency->value,
            "description" => $this->description,
            "return_url" => "http=>//merchant.site.uz/return_URL",
            "notify_url" => "http=>//merchant.site.uz/send_me_status_URL",
            "ttl" => 15
        ];

        if ($this->tspId) {
            $result['tsp_id'] = $this->tspId;
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
