<?php

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
