<?php

namespace MailCampaigns\ApiClient\Entity;

class ProductVolumeSellProduct implements EntityInterface
{
    use LinkedProductTrait;

    public static $endpoint = '/product_volume_sell_products';

    public function __destruct()
    {
        unset($this->product);
        unset($this->linkedProduct);
    }
}
