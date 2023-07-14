<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Api;

use MailCampaigns\ApiClient\Collection\QuoteProductCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Product;
use MailCampaigns\ApiClient\Entity\Quote;
use MailCampaigns\ApiClient\Entity\QuoteProduct;

class QuoteProductApi extends AbstractApi
{
    public function create(QuoteProduct|EntityInterface $entity): QuoteProduct
    {
        assert($entity instanceof QuoteProduct);
        return $this->toEntity($this->post('quote_products', $entity));
    }

    public function getById(int|string $id): QuoteProduct
    {
        return $this->toEntity($this->get("quote_products/$id"));
    }

    public function getCollection(
        ?int $page = null,
        ?int $perPage = null
    ): QuoteProductCollection {
        $data = $this->get('quote_products', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        $collection = $this->toCollection($data, QuoteProductCollection::class);
        assert($collection instanceof QuoteProductCollection);

        return $collection;
    }

    public function update(QuoteProduct|EntityInterface $entity): QuoteProduct
    {
        assert($entity instanceof QuoteProduct);

        return $this->toEntity(
            $this->put("quote_products/{$entity->getQuoteProductId()}", $entity)
        );
    }

    public function deleteById(int|string $id): self
    {
        $this->delete("quote_products/$id");
        return $this;
    }


    public function toEntity(array $data): QuoteProduct
    {
        $quoteProduct = (new QuoteProduct())
            ->setQuoteProductId($data['quote_product_id'])
            ->setBrandTitle($data['brand_title'])
            ->setProductTitle($data['product_title'])
            ->setBaseColli($data['base_colli'])
            ->setBasePriceCost($data['base_price_cost'])
            ->setBasePriceExcl($data['base_price_excl'])
            ->setBasePriceIncl($data['base_price_incl'])
            ->setQuantity($data['quantity'])
            ->setDiscountPercentage($data['discount_percentage'])
            ->setTaxRate($data['tax_rate'])
            ->setPriceCost($data['price_cost'])
            ->setPriceTax($data['price_tax'])
            ->setPriceExcl($data['price_excl'])
            ->setPriceIncl($data['price_incl'])
            ->setDiscountExcl($data['discount_excl'])
            ->setDiscountIncl($data['discount_incl'])
            ->setAdditionalCostExcl($data['additional_cost_excl'])
            ->setAdditionalCostIncl($data['additional_cost_incl'])
            ->setBaseAdditionalCostExcl($data['additional_cost_excl'])
            ->setBaseAdditionalCostIncl($data['additional_cost_incl'])
            ->setLineRef($data['line_ref']);

        // Set linked quote.
        if (isset($data['quote']) && is_string($data['quote'])) {
            if (false !== preg_match('/\/quotes\/(\d+)/', $data['quote'], $matches)) {
                if (isset($matches[1])) {
                    $quoteId = (int)$matches[1];

                    $quoteProduct->setQuote(
                        (new Quote())
                            ->setQuoteId($quoteId)
                            ->addQuoteProduct($quoteProduct)
                    );
                }
            }
        }

        // Set linked product.
        if (isset($data['product']) && is_string($data['product'])) {
            if (false !== preg_match('/\/products\/(\d+)/', $data['product'], $matches)) {
                if (isset($matches[1])) {
                    $product = (new Product())->setProductId((int)$matches[1]);
                    $quoteProduct->setProduct($product);
                }
            }
        }

        return $quoteProduct;
    }
}
