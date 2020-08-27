<?php

namespace MailCampaigns\ApiClient\Entity;

class ProductUpSellProduct implements EntityInterface
{
    use LinkedProductTrait;

    public static $endpoint = '/product_up_sell_products';
}
