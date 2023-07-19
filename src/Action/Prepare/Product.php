<?php

declare(strict_types=1);

namespace Daniil\OctoBundle\Action\Prepare;

use JsonSerializable;

/**
 * Class Product
 *
 * Товар корзины.
 *
 * @package Daniil\OctoBundle\Action\Prepare
 */
final readonly class Product implements JsonSerializable
{
    public function __construct(
        private string $positionDesc,
        private int    $count,
        private float  $price,
        private ?int   $supplierShopId = null
    )
    {
    }

    public function jsonSerialize(): array
    {
        $result = [
            'position_desc' => $this->positionDesc,
            'count' => $this->count,
            'price' => $this->price
        ];

        if ($this->supplierShopId) {
            $result['supplier_shop_id'] = $this->supplierShopId;
        }

        return $result;
    }
}
