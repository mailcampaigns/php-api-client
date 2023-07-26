<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

class ProductUpSellProduct implements EntityInterface
{
    use LinkedProductTrait;

    public static string $endpoint = '/product_up_sell_products';

    public function __destruct()
    {
        unset($this->product);
        unset($this->linkedProduct);
    }
}
