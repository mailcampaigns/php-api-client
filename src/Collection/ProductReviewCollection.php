<?php

namespace MailCampaigns\ApiClient\Collection;

use MailCampaigns\ApiClient\Entity\ProductReview;

class ProductReviewCollection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    public function toIri(): array
    {
        $iris = [];

        /** @var ProductReview $review */
        foreach ($this->getIterator() as $review) {
            $iris[] = $review instanceof ProductReview ? $review->toIri() : $review;
        }

        return $iris;
    }
}
