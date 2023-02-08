<?php

namespace MailCampaigns\ApiClient\Api;

use InvalidArgumentException;
use MailCampaigns\ApiClient\Collection\CollectionInterface;
use MailCampaigns\ApiClient\Collection\QuoteProductCollection;
use MailCampaigns\ApiClient\Entity\EntityInterface;
use MailCampaigns\ApiClient\Entity\Quote;
use MailCampaigns\ApiClient\Entity\QuoteProduct;
use MailCampaigns\ApiClient\Entity\Product;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface as HttpClientExceptionInterface;

class QuoteProductApi extends AbstractApi
{
    /**
     * @param EntityInterface|QuoteProduct $entity
     * @return QuoteProduct
     * @throws HttpClientExceptionInterface
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        if (!$entity instanceof QuoteProduct) {
            throw new InvalidArgumentException('Expected quote product entity!');
        }

        // Send request.
        $res = $this->post('quote_products', $entity);

        return $this->toEntity($res);
    }

    /**
     * {@inheritDoc}
     * @return QuoteProduct
     */
    public function getById($id): EntityInterface
    {
        return $this->toEntity($this->get("quote_products/{$id}"));
    }

    /**
     * {@inheritDoc}
     * @return QuoteProductCollection
     */
    public function getCollection(?int $page = null, ?int $perPage = null): CollectionInterface
    {
        $data = $this->get('quote_products', [
            'page' => $page ?? 1,
            'itemsPerPage' => $perPage ?? self::DEFAULT_ITEMS_PER_PAGE
        ]);

        return $this->toCollection($data, QuoteProductCollection::class);
    }

    /**
     * Updates a quote product.
     *
     * @param EntityInterface $entity
     * @return QuoteProduct
     * @throws HttpClientExceptionInterface
     */
    public function update(EntityInterface $entity): EntityInterface
    {
        if (!$entity instanceof QuoteProduct) {
            throw new InvalidArgumentException(sprintf('Expected an instance of %s!',
                QuoteProduct::class));
        }

        $res = $this->put("quote_products/{$entity->getQuoteProductId()}", $entity);

        return $this->toEntity($res);
    }

    /**
     * Deletes a quote product by id.
     *
     * @param int $id
     * @return $this
     * @throws HttpClientExceptionInterface
     */
    public function deleteById($id): ApiInterface
    {
        $this->delete("quote_products/{$id}");
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toEntity(array $data): EntityInterface
    {
        $quoteProduct = (new QuoteProduct)
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
                        (new Quote)
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
                    $product = (new Product)->setProductId((int)$matches[1]);
                    $quoteProduct->setProduct($product);
                }
            }
        }

        return $quoteProduct;
    }
}
