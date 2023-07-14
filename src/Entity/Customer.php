<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

use DateTime;
use DateTimeInterface;
use LogicException;
use MailCampaigns\ApiClient\Collection\CustomerCustomFieldCollection;
use MailCampaigns\ApiClient\Collection\CustomerFavoriteProductCollection;
use MailCampaigns\ApiClient\Collection\OrderCollection;
use MailCampaigns\ApiClient\Collection\ProductReviewCollection;
use MailCampaigns\ApiClient\Collection\QuoteCollection;

class Customer implements EntityInterface, CustomFieldAwareEntityInterface
{
    use DateTrait;
    use DateTimeHelperTrait;

    public function __construct(
        private ?int $customerId = null,
        private ?string $customerRef = null,
        private ?string $origin = null,
        private ?bool $isSubscribed = null,
        private ?bool $isConfirmed = null,
        private ?string $gender = null,
        private ?DateTimeInterface $birthDate = null,
        private ?string $email = null,
        private ?string $firstName = null,
        private ?string $middleName = null,
        private ?string $lastName = null,
        private ?string $phone = null,
        private ?string $mobile = null,
        private ?string $companyName = null,
        private ?string $companyCocNumber = null,
        private ?string $companyVatNumber = null,
        private ?string $addressBillingName = null,
        private ?string $addressBillingStreet = null,
        private ?string $addressBillingNumber = null,
        private ?string $addressBillingExtension = null,
        private ?string $addressBillingZipcode = null,
        private ?string $addressBillingCity = null,
        private ?string $addressBillingRegion = null,
        private ?string $addressBillingCountry = null,
        private ?string $addressShippingCompany = null,
        private ?string $addressShippingName = null,
        private ?string $addressShippingStreet = null,
        private ?string $addressShippingNumber = null,
        private ?string $addressShippingExtension = null,
        private ?string $addressShippingZipcode = null,
        private ?string $addressShippingCity = null,
        private ?string $addressShippingRegion = null,
        private ?string $addressShippingCountry = null,
        private ?string $language = null,
        private ?OrderCollection $orders = new OrderCollection(),
        private ?ProductReviewCollection $productReviews = new ProductReviewCollection(),
        private ?CustomerFavoriteProductCollection $favorites = new CustomerFavoriteProductCollection(),
        private ?QuoteCollection $quotes = new QuoteCollection(),
        private ?CustomerCustomFieldCollection $customFields = new CustomerCustomFieldCollection(),
    ) {
        $this->createdAt = new DateTime();
    }

    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    public function setCustomerId(?int $customerId): self
    {
        $this->customerId = $customerId;
        return $this;
    }

    public function getCustomerRef(): ?string
    {
        return $this->customerRef;
    }

    public function setCustomerRef(?string $customerRef): self
    {
        $this->customerRef = $customerRef;
        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(?string $origin): self
    {
        $this->origin = $origin;
        return $this;
    }

    public function isSubscribed(): ?bool
    {
        return $this->isSubscribed;
    }

    public function setIsSubscribed(?bool $isSubscribed): self
    {
        $this->isSubscribed = $isSubscribed;
        return $this;
    }

    public function isConfirmed(): ?bool
    {
        return $this->isConfirmed;
    }

    public function setIsConfirmed(?bool $isConfirmed): self
    {
        $this->isConfirmed = $isConfirmed;
        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    public function getBirthDate(): ?DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function setMiddleName(?string $middleName): self
    {
        $this->middleName = $middleName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): self
    {
        $this->mobile = $mobile;
        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;
        return $this;
    }

    public function getCompanyCocNumber(): ?string
    {
        return $this->companyCocNumber;
    }

    public function setCompanyCocNumber(?string $companyCocNumber): self
    {
        $this->companyCocNumber = $companyCocNumber;
        return $this;
    }

    public function getCompanyVatNumber(): ?string
    {
        return $this->companyVatNumber;
    }

    public function setCompanyVatNumber(?string $companyVatNumber): self
    {
        $this->companyVatNumber = $companyVatNumber;
        return $this;
    }

    public function getAddressBillingName(): ?string
    {
        return $this->addressBillingName;
    }

    public function setAddressBillingName(?string $addressBillingName): self
    {
        $this->addressBillingName = $addressBillingName;
        return $this;
    }

    public function getAddressBillingStreet(): ?string
    {
        return $this->addressBillingStreet;
    }

    public function setAddressBillingStreet(?string $addressBillingStreet): self
    {
        $this->addressBillingStreet = $addressBillingStreet;
        return $this;
    }

    public function getAddressBillingNumber(): ?string
    {
        return $this->addressBillingNumber;
    }

    public function setAddressBillingNumber(?string $addressBillingNumber): self
    {
        $this->addressBillingNumber = $addressBillingNumber;
        return $this;
    }

    public function getAddressBillingExtension(): ?string
    {
        return $this->addressBillingExtension;
    }

    public function setAddressBillingExtension(?string $addressBillingExtension): self
    {
        $this->addressBillingExtension = $addressBillingExtension;
        return $this;
    }

    public function getAddressBillingZipcode(): ?string
    {
        return $this->addressBillingZipcode;
    }

    public function setAddressBillingZipcode(?string $addressBillingZipcode): self
    {
        $this->addressBillingZipcode = $addressBillingZipcode;
        return $this;
    }

    public function getAddressBillingCity(): ?string
    {
        return $this->addressBillingCity;
    }

    public function setAddressBillingCity(?string $addressBillingCity): self
    {
        $this->addressBillingCity = $addressBillingCity;
        return $this;
    }

    public function getAddressBillingRegion(): ?string
    {
        return $this->addressBillingRegion;
    }

    public function setAddressBillingRegion(?string $addressBillingRegion): self
    {
        $this->addressBillingRegion = $addressBillingRegion;
        return $this;
    }

    public function getAddressBillingCountry(): ?string
    {
        return $this->addressBillingCountry;
    }

    public function setAddressBillingCountry(?string $addressBillingCountry): self
    {
        $this->addressBillingCountry = $addressBillingCountry;
        return $this;
    }

    public function getAddressShippingCompany(): ?string
    {
        return $this->addressShippingCompany;
    }

    public function setAddressShippingCompany(?string $addressShippingCompany): self
    {
        $this->addressShippingCompany = $addressShippingCompany;
        return $this;
    }

    public function getAddressShippingName(): ?string
    {
        return $this->addressShippingName;
    }

    public function setAddressShippingName(?string $addressShippingName): self
    {
        $this->addressShippingName = $addressShippingName;
        return $this;
    }

    public function getAddressShippingStreet(): ?string
    {
        return $this->addressShippingStreet;
    }

    public function setAddressShippingStreet(?string $addressShippingStreet): self
    {
        $this->addressShippingStreet = $addressShippingStreet;
        return $this;
    }

    public function getAddressShippingNumber(): ?string
    {
        return $this->addressShippingNumber;
    }

    public function setAddressShippingNumber(?string $addressShippingNumber): self
    {
        $this->addressShippingNumber = $addressShippingNumber;
        return $this;
    }

    public function getAddressShippingExtension(): ?string
    {
        return $this->addressShippingExtension;
    }

    public function setAddressShippingExtension(?string $addressShippingExtension): self
    {
        $this->addressShippingExtension = $addressShippingExtension;
        return $this;
    }

    public function getAddressShippingZipcode(): ?string
    {
        return $this->addressShippingZipcode;
    }

    public function setAddressShippingZipcode(?string $addressShippingZipcode): self
    {
        $this->addressShippingZipcode = $addressShippingZipcode;
        return $this;
    }

    public function getAddressShippingCity(): ?string
    {
        return $this->addressShippingCity;
    }

    public function setAddressShippingCity(?string $addressShippingCity): self
    {
        $this->addressShippingCity = $addressShippingCity;
        return $this;
    }

    public function getAddressShippingRegion(): ?string
    {
        return $this->addressShippingRegion;
    }

    public function setAddressShippingRegion(?string $addressShippingRegion): self
    {
        $this->addressShippingRegion = $addressShippingRegion;
        return $this;
    }

    public function getAddressShippingCountry(): ?string
    {
        return $this->addressShippingCountry;
    }

    public function setAddressShippingCountry(?string $addressShippingCountry): self
    {
        $this->addressShippingCountry = $addressShippingCountry;
        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;
        return $this;
    }

    public function getOrders(): OrderCollection
    {
        return $this->orders;
    }

    public function setOrders(?iterable $orders): self
    {
        $this->orders = new OrderCollection();

        if ($orders) {
            foreach ($orders as $data) {
                $order = null;

                if ($data instanceof Order) {
                    $order = $data;
                } else {
                    if (is_string($data)) {
                        // Convert order IRI (string) to an Order entity.
                        $order = $this->iriToOrderEntity($data);
                    } else {
                        throw new LogicException('Order is neither an array nor an IRI!');
                    }
                }

                $this->addOrder($order);
            }
        }

        return $this;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            if ($order->getCustomer() !== $this) {
                $order->setCustomer($this);
            }

            $this->orders->add($order);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->contains($order)) {
            $order->setCustomer(null);
            $this->orders->removeElement($order);
        }

        return $this;
    }

    public function getProductReviews(): ProductReviewCollection
    {
        return $this->productReviews;
    }

    public function setProductReviews(ProductReviewCollection $productReviews): self
    {
        $this->productReviews = $productReviews;
        return $this;
    }

    public function getFavorites(): CustomerFavoriteProductCollection
    {
        return $this->favorites;
    }

    public function setFavorites(?iterable $favorites): self
    {
        $this->favorites = new CustomerFavoriteProductCollection();

        if ($favorites) {
            foreach ($favorites as $data) {
                $favorite = null;

                if ($data instanceof CustomerFavoriteProduct) {
                    $favorite = $data;
                } else {
                    if (is_string($data)) {
                        // Convert favorite IRI to a favorite entity.
                        $favorite = $this->iriToFavoriteEntity($data);
                    } else {
                        if (is_array($data)) {
                            $favorite = $this->arrayToFavorite($data);
                        } else {
                            throw new LogicException('Favorite is neither an array nor an IRI!');
                        }
                    }
                }

                $this->addFavorite($favorite);
            }
        }

        return $this;
    }

    public function addFavorite(CustomerFavoriteProduct $favorite): self
    {
        if (!$this->favorites->contains($favorite)) {
            if ($favorite->getCustomer() !== $this) {
                $favorite->setCustomer($this);
            }

            $this->favorites->add($favorite);
        }

        return $this;
    }

    public function getQuotes(): QuoteCollection
    {
        return $this->quotes;
    }

    public function setQuotes(?iterable $quotes): self
    {
        $this->quotes = new QuoteCollection();

        if ($quotes) {
            foreach ($quotes as $data) {
                $quote = null;

                if ($data instanceof Quote) {
                    $quote = $data;
                } else {
                    if (is_string($data)) {
                        // Convert quote IRI to a quote entity.
                        $quote = $this->iriToQuoteEntity($data);
                    } else {
                        throw new LogicException('Quote is neither an array nor an IRI!');
                    }
                }

                $this->addQuote($quote);
            }
        }

        return $this;
    }

    public function addQuote(Quote $quote): self
    {
        if (!$this->quotes->contains($quote)) {
            if ($quote->getCustomer() !== $this) {
                $quote->setCustomer($this);
            }

            $this->quotes->add($quote);
        }

        return $this;
    }

    public function removeQuote(Quote $quote): self
    {
        if ($this->quotes->contains($quote)) {
            $quote->setCustomer(null);
            $this->quotes->removeElement($quote);
        }

        return $this;
    }

    public function getCustomFields(): CustomerCustomFieldCollection
    {
        return $this->customFields;
    }

    public function setCustomFields(?iterable $customFields): self
    {
        $this->customFields = new CustomerCustomFieldCollection();

        if ($customFields) {
            foreach ($customFields as $data) {
                $customField = null;

                if ($data instanceof CustomerCustomField) {
                    $customField = $data;
                } else {
                    if (is_array($data)) {
                        $customField = (new CustomerCustomField())
                            ->setCustomFieldId($data['custom_field_id'])
                            ->setCustomer($this)
                            ->setName($data['name'])
                            ->setValue($data['value']);
                    } else {
                        if (is_string($data)) {
                            // Convert customField IRI to a customField entity.
                            $customField = $this->iriToCustomerCustomFieldEntity($data);
                        } else {
                            throw new LogicException('Custom field is of an unexpected type!');
                        }
                    }
                }

                $this->addCustomField($customField);
            }
        }

        return $this;
    }

    public function addCustomField(CustomFieldInterface $customField): CustomFieldAwareEntityInterface
    {
        assert($customField instanceof CustomerCustomField);

        if (!$this->customFields->contains($customField)) {
            if ($customField->getCustomer() !== $this) {
                $customField->setCustomer($this);
            }

            $this->customFields->add($customField);
        }

        return $this;
    }

    public function removeCustomField(CustomFieldInterface $customField): CustomFieldAwareEntityInterface
    {
        assert($customField instanceof CustomerCustomField);

        if ($this->customFields->contains($customField)) {
            $customField->setCustomer(null);
            $this->customFields->removeElement($customField);
        }

        return $this;
    }

    public function toArray(?string $operation = null, ?bool $isRoot = false): array
    {
        return [
            'customer_id' => $this->getCustomerId(),
            'created_at' => $this->dtToString($this->getCreatedAt()),
            'updated_at' => $this->dtToString($this->getUpdatedAt()),
            'customer_ref' => $this->getCustomerRef(),
            'origin' => $this->getOrigin(),
            'is_subscribed' => $this->isSubscribed(),
            'is_confirmed' => $this->isConfirmed(),
            'gender' => $this->getGender(),
            'birth_date' => $this->dtToString($this->getBirthDate()),
            'email' => $this->getEmail(),
            'first_name' => $this->getFirstName(),
            'middle_name' => $this->getMiddleName(),
            'last_name' => $this->getLastName(),
            'phone' => $this->getPhone(),
            'mobile' => $this->getMobile(),
            'company_name' => $this->getCompanyName(),
            'company_coc_number' => $this->getCompanyCocNumber(),
            'company_vat_number' => $this->getCompanyVatNumber(),
            'address_billing_name' => $this->getAddressBillingName(),
            'address_billing_street' => $this->getAddressBillingStreet(),
            'address_billing_number' => $this->getAddressBillingNumber(),
            'address_billing_extension' => $this->getAddressBillingExtension(),
            'address_billing_zipcode' => $this->getAddressBillingZipcode(),
            'address_billing_city' => $this->getAddressBillingCity(),
            'address_billing_region' => $this->getAddressBillingRegion(),
            'address_billing_country' => $this->getAddressBillingCountry(),
            'address_shipping_company' => $this->getAddressShippingCompany(),
            'address_shipping_name' => $this->getAddressShippingName(),
            'address_shipping_street' => $this->getAddressShippingStreet(),
            'address_shipping_number' => $this->getAddressShippingNumber(),
            'address_shipping_extension' => $this->getAddressShippingExtension(),
            'address_shipping_zipcode' => $this->getAddressShippingZipcode(),
            'address_shipping_city' => $this->getAddressShippingCity(),
            'address_shipping_region' => $this->getAddressShippingRegion(),
            'address_shipping_country' => $this->getAddressShippingCountry(),
            'language' => $this->getLanguage(),
            'orders' => $this->getOrders()->toArray($operation),
            'product_reviews' => $this->getProductReviews()->toArray($operation),
            'favorites' => $this->getFavorites()->toArray($operation),
            'quotes' => $this->getQuotes()->toArray($operation),
            'custom_fields' => $this->getCustomFields()->toArray($operation)
        ];
    }


    public function toIri(): ?string
    {
        if (null === $this->getCustomerId()) {
            return null;
        }

        return '/customers/' . $this->getCustomerId();
    }

    private function iriToOrderEntity(string $iri): Order
    {
        $id = (int)str_replace('/orders/', '', $iri);
        return (new Order())->setOrderId($id);
    }

    private function iriToQuoteEntity(string $iri): Quote
    {
        $id = (int)str_replace('/quotes/', '', $iri);
        return (new Quote())->setQuoteId($id);
    }

    private function iriToFavoriteEntity(string $iri): CustomerFavoriteProduct
    {
        //"/customer_favorite_products/customer=4;favoriteProduct=1"
        $id = (int)str_replace('/customer_favorite_products/', '', $iri);

        return (new CustomerFavoriteProduct())
            ->setCustomer($this)
            ->setProduct((new Product())->setProductId($id));
    }

    private function arrayToFavorite(array $data): CustomerFavoriteProduct
    {
        $productId = null;
        $pattern = '/\/products\/(?\'product_id\'\d+)/';

        if (false !== preg_match($pattern, $data['favorite_product'], $matches)) {
            if (isset($matches['product_id'])) {
                $productId = (int)$matches['product_id'];
            }
        }

        if (null === $productId) {
            throw new LogicException('Could not determine product id!');
        }

        $product = (new Product())->setProductId($productId);

        return (new CustomerFavoriteProduct())
            ->setCustomer($this)
            ->setProduct($product);
    }

    private function iriToCustomerCustomFieldEntity(string $iri): CustomerCustomField
    {
        $id = (int)str_replace('/customer_custom_fields/', '', $iri);
        return (new CustomerCustomField())->setCustomFieldId($id);
    }

    public function getNewCustomField(): CustomFieldInterface
    {
        return new CustomerCustomField();
    }

    public function __clone()
    {
        $this->customFields = clone $this->customFields;
    }

    public function __destruct()
    {
        unset($this->createdAt);
        unset($this->updatedAt);
        unset($this->birthDate);
        unset($this->orders);
        unset($this->productReviews);
        unset($this->favorites);
        unset($this->quotes);
        unset($this->customFields);
    }
}
