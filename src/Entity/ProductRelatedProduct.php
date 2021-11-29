<?php

namespace MailCampaigns\ApiClient\Entity;

class ProductRelatedProduct implements EntityInterface
{
    use LinkedProductTrait;

    public static $endpoint = '/product_related_products';

    public function __destruct()
    {
        unset($this->product);
        unset($this->linkedProduct);
    }
}
