<?php

namespace MailCampaigns\ApiClient\Entity;

class ProductReview implements EntityInterface
{
    public function toArray(): array
    {
        // TODO: Implement toArray() method.
        return [
        ];
    }

    public function toIri(): string
    {
        // todo: check?
        return '/product_reviews/' . $this->getProductReviewId();
    }
}
