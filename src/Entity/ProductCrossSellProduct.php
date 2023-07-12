<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

class ProductCrossSellProduct implements EntityInterface
{
    use LinkedProductTrait;

    public static $endpoint = '/product_cross_sell_products';

    public function __destruct()
    {
        unset($this->product);
        unset($this->linkedProduct);
    }
}
