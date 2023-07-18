<?php

declare(strict_types=1);

namespace Daniil\OctoBundle\Action\Prepare;

use Ramsey\Collection\Collection;

/**
 * Class ProductCollection
 *
 * Коллекция товаров корзины.
 *
 * @package Daniil\OctoBundle\Action\Prepare
 */
final class ProductCollection extends Collection
{
    public function __construct(array $data = [])
    {
        parent::__construct(Product::class, $data);
    }
}
