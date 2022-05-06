<?php

namespace MailCampaigns\ApiClient\Entity;

use DateTime;
use LogicException;
use MailCampaigns\ApiClient\Collection\CustomerCustomFieldCollection;
use MailCampaigns\ApiClient\Collection\CustomerFavoriteProductCollection;
use MailCampaigns\ApiClient\Collection\OrderCollection;
use MailCampaigns\ApiClient\Collection\ProductReviewCollection;
use MailCampaigns\ApiClient\Collection\QuoteCollection;

class Customer implements EntityInterface
{
    use DateTimeHelperTrait;

    /**
     * @var int
     */
    protected $customerId;

    /**
     * @var DateTime
     */
    protected $createdAt;

    /**
     * @var DateTime
     */
    protected $updatedAt;

    /**
     * @var string
     */
    protected $customerRef;

    /**
     * @var string
     */
    protected $origin;

    /**
     * @var bool
     */
    protected $isSubscribed;

    /**
     * @var bool
     */
    protected $isConfirmed;

    /**
     * @var string
     */
    protected $gender;

    /**
     * @var DateTime
     */
    protected $birthDate;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $middleName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $mobile;

    /**
     * @var string
     */
    protected $companyName;

    /**
     * @var string
     */
    protected $companyCocNumber;

    /**
     * @var string
     */
    protected $companyVatNumber;

    /**
     * Billing address name.
     *
     * @var string
     */
    protected $addressBillingName;

    /**
     * Billing address street.
     *
     * @var string
     */
    protected $addressBillingStreet;

    /**
     * Billing address house number.
     *
     * @var string
     */
    protected $addressBillingNumber;

    /**
     * Billing address house number extension.
     *
     * @var string
     */
    protected $addressBillingExtension;

    /**
     * Billing address zipcode.
     *
     * @var string
     */
    protected $addressBillingZipcode;

    /**
     * Billing address city.
     *
     * @var string
     */
    protected $addressBillingCity;

    /**
     * Billing address region.
     *
     * @var string
     */
    protected $addressBillingRegion;

    /**
     * Billing address country.
     *
     * @var string
     */
    protected $addressBillingCountry;

    /**
     * Shipping address company name.
     *
     * @var string
     */
    protected $addressShippingCompany;

    /**
     * Shipping address name.
     *
     * @var string
     */
    protected $addressShippingName;

    /**
     * Shipping address street.
     *
     * @var string
     */
    protected $addressShippingStreet;

    /**
     * Shipping address house number.
     *
     * @var string
     */
    protected $addressShippingNumber;

    /**
     * Shipping address house number extension.
     *
     * @var string
     */
    protected $addressShippingExtension;

    /**
     * Shipping address zipcode.
     *
     * @var string
     */
    protected $addressShippingZipcode;

    /**
     * Shipping address city.
     *
     * @var string
     */
    protected $addressShippingCity;

    /**
     * Shipping address region.
     *
     * @var string
     */
    protected $addressShippingRegion;

    /**
     * Shipping address country.
     *
     * @var string
     */
    protected $addressShippingCountry;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var OrderCollection
     */
    protected $orders;

    /**
     * @var ProductReviewCollection
     */
    protected $productReviews;

    /**
     * @var CustomerFavoriteProductCollection
     */
    protected $favorites;

    /**
     * @var QuoteCollection
     */
    protected $quotes;

    /**
     * @var CustomerCustomFieldCollection
     */
    protected $customFields;

    public function __construct()
    {
        $this->createdAt = new DateTime;
        $this->orders = new OrderCollection;
        $this->productReviews = new ProductReviewCollection;
        $this->favorites = new CustomerFavoriteProductCollection;
        $this->quotes = new QuoteCollection;
        $this->customFields = new CustomerCustomFieldCollection;
    }

    /**
     * @return int
     */
    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    /**
     * @param int|null $customerId
     * @return $this
     */
    public function setCustomerId(?int $customerId): self
    {
        $this->customerId = $customerId;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime|null $createdAt
     * @return $this
     */
    public function setCreatedAt(?DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime|null $updatedAt
     * @return $this
     */
    public function setUpdatedAt(?DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRef(): ?string
    {
        return $this->customerRef;
    }

    /**
     * @param string|null $customerRef
     * @return $this
     */
    public function setCustomerRef(?string $customerRef): self
    {
        $this->customerRef = $customerRef;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    /**
     * @param string|null $origin
     * @return $this
     */
    public function setOrigin(?string $origin): self
    {
        $this->origin = $origin;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isSubscribed(): ?bool
    {
        return $this->isSubscribed;
    }

    /**
     * @param bool|null $isSubscribed
     * @return $this
     */
    public function setIsSubscribed(?bool $isSubscribed): self
    {
        $this->isSubscribed = $isSubscribed;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isConfirmed(): ?bool
    {
        return $this->isConfirmed;
    }

    /**
     * @param bool|null $isConfirmed
     * @return $this
     */
    public function setIsConfirmed(?bool $isConfirmed): self
    {
        $this->isConfirmed = $isConfirmed;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string|null $gender
     * @return $this
     */
    public function setGender(?string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getBirthDate(): ?DateTime
    {
        return $this->birthDate;
    }

    /**
     * @param DateTime|null $birthDate
     * @return $this
     */
    public function setBirthDate(?DateTime $birthDate): self
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * @param string|null $middleName
     * @return $this
     */
    public function setMiddleName(?string $middleName): self
    {
        $this->middleName = $middleName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return $this
     */
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    /**
     * @param string|null $mobile
     * @return $this
     */
    public function setMobile(?string $mobile): self
    {
        $this->mobile = $mobile;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    /**
     * @param string|null $companyName
     * @return $this
     */
    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompanyCocNumber(): ?string
    {
        return $this->companyCocNumber;
    }

    /**
     * @param string|null $companyCocNumber
     * @return $this
     */
    public function setCompanyCocNumber(?string $companyCocNumber): self
    {
        $this->companyCocNumber = $companyCocNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompanyVatNumber(): ?string
    {
        return $this->companyVatNumber;
    }

    /**
     * @param string|null $companyVatNumber
     * @return $this
     */
    public function setCompanyVatNumber(?string $companyVatNumber): self
    {
        $this->companyVatNumber = $companyVatNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressBillingName(): ?string
    {
        return $this->addressBillingName;
    }

    /**
     * @param string|null $addressBillingName
     * @return $this
     */
    public function setAddressBillingName(?string $addressBillingName): self
    {
        $this->addressBillingName = $addressBillingName;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressBillingStreet(): ?string
    {
        return $this->addressBillingStreet;
    }

    /**
     * @param string|null $addressBillingStreet
     * @return $this
     */
    public function setAddressBillingStreet(?string $addressBillingStreet): self
    {
        $this->addressBillingStreet = $addressBillingStreet;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressBillingNumber(): ?string
    {
        return $this->addressBillingNumber;
    }

    /**
     * @param string|null $addressBillingNumber
     * @return $this
     */
    public function setAddressBillingNumber(?string $addressBillingNumber): self
    {
        $this->addressBillingNumber = $addressBillingNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressBillingExtension(): ?string
    {
        return $this->addressBillingExtension;
    }

    /**
     * @param string|null $addressBillingExtension
     * @return $this
     */
    public function setAddressBillingExtension(?string $addressBillingExtension): self
    {
        $this->addressBillingExtension = $addressBillingExtension;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressBillingZipcode(): ?string
    {
        return $this->addressBillingZipcode;
    }

    /**
     * @param string|null $addressBillingZipcode
     * @return $this
     */
    public function setAddressBillingZipcode(?string $addressBillingZipcode): self
    {
        $this->addressBillingZipcode = $addressBillingZipcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressBillingCity(): ?string
    {
        return $this->addressBillingCity;
    }

    /**
     * @param string|null $addressBillingCity
     * @return $this
     */
    public function setAddressBillingCity(?string $addressBillingCity): self
    {
        $this->addressBillingCity = $addressBillingCity;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressBillingRegion(): ?string
    {
        return $this->addressBillingRegion;
    }

    /**
     * @param string|null $addressBillingRegion
     * @return $this
     */
    public function setAddressBillingRegion(?string $addressBillingRegion): self
    {
        $this->addressBillingRegion = $addressBillingRegion;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressBillingCountry(): ?string
    {
        return $this->addressBillingCountry;
    }

    /**
     * @param string|null $addressBillingCountry
     * @return $this
     */
    public function setAddressBillingCountry(?string $addressBillingCountry): self
    {
        $this->addressBillingCountry = $addressBillingCountry;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressShippingCompany(): ?string
    {
        return $this->addressShippingCompany;
    }

    /**
     * @param string|null $addressShippingCompany
     * @return $this
     */
    public function setAddressShippingCompany(?string $addressShippingCompany): self
    {
        $this->addressShippingCompany = $addressShippingCompany;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressShippingName(): ?string
    {
        return $this->addressShippingName;
    }

    /**
     * @param string|null $addressShippingName
     * @return $this
     */
    public function setAddressShippingName(?string $addressShippingName): self
    {
        $this->addressShippingName = $addressShippingName;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressShippingStreet(): ?string
    {
        return $this->addressShippingStreet;
    }

    /**
     * @param string|null $addressShippingStreet
     * @return $this
     */
    public function setAddressShippingStreet(?string $addressShippingStreet): self
    {
        $this->addressShippingStreet = $addressShippingStreet;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressShippingNumber(): ?string
    {
        return $this->addressShippingNumber;
    }

    /**
     * @param string|null $addressShippingNumber
     * @return $this
     */
    public function setAddressShippingNumber(?string $addressShippingNumber): self
    {
        $this->addressShippingNumber = $addressShippingNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressShippingExtension(): ?string
    {
        return $this->addressShippingExtension;
    }

    /**
     * @param string|null $addressShippingExtension
     * @return $this
     */
    public function setAddressShippingExtension(?string $addressShippingExtension): self
    {
        $this->addressShippingExtension = $addressShippingExtension;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressShippingZipcode(): ?string
    {
        return $this->addressShippingZipcode;
    }

    /**
     * @param string|null $addressShippingZipcode
     * @return $this
     */
    public function setAddressShippingZipcode(?string $addressShippingZipcode): self
    {
        $this->addressShippingZipcode = $addressShippingZipcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressShippingCity(): ?string
    {
        return $this->addressShippingCity;
    }

    /**
     * @param string|null $addressShippingCity
     * @return $this
     */
    public function setAddressShippingCity(?string $addressShippingCity): self
    {
        $this->addressShippingCity = $addressShippingCity;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressShippingRegion(): ?string
    {
        return $this->addressShippingRegion;
    }

    /**
     * @param string|null $addressShippingRegion
     * @return $this
     */
    public function setAddressShippingRegion(?string $addressShippingRegion): self
    {
        $this->addressShippingRegion = $addressShippingRegion;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressShippingCountry(): ?string
    {
        return $this->addressShippingCountry;
    }

    /**
     * @param string|null $addressShippingCountry
     * @return $this
     */
    public function setAddressShippingCountry(?string $addressShippingCountry): self
    {
        $this->addressShippingCountry = $addressShippingCountry;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * @param string|null $language
     * @return $this
     */
    public function setLanguage(?string $language): self
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return OrderCollection
     */
    public function getOrders(): OrderCollection
    {
        return $this->orders;
    }

    /**
     * @param iterable|OrderCollection|null $orders
     * @return $this
     */
    public function setOrders(?iterable $orders): self
    {
        $this->orders = new OrderCollection;

        if ($orders) {
            foreach ($orders as $data) {
                $order = null;

                if ($data instanceof Order) {
                    $order = $data;
                } else if (is_string($data)) {
                    // Convert order IRI (string) to an Order entity.
                    $order = $this->iriToOrderEntity($data);
                } else {
                    throw new LogicException('Order is neither an array nor an IRI!');
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

    /**
     * @return ProductReviewCollection
     */
    public function getProductReviews(): ProductReviewCollection
    {
        return $this->productReviews;
    }

    /**
     * @param ProductReviewCollection $productReviews
     * @return $this
     */
    public function setProductReviews(ProductReviewCollection $productReviews): self
    {
        $this->productReviews = $productReviews;
        return $this;
    }

    /**
     * @return CustomerFavoriteProductCollection
     */
    public function getFavorites(): CustomerFavoriteProductCollection
    {
        return $this->favorites;
    }

    /**
     * @param iterable|CustomerFavoriteProductCollection|null $favorites
     * @return $this
     */
    public function setFavorites(?iterable $favorites): self
    {
        $this->favorites = new CustomerFavoriteProductCollection;

        if ($favorites) {
            foreach ($favorites as $data) {
                $favorite = null;

                if ($data instanceof CustomerFavoriteProduct) {
                    $favorite = $data;
                } else if (is_string($data)) {
                    // Convert favorite IRI to a favorite entity.
                    $favorite = $this->iriToFavoriteEntity($data);
                } else if (is_array($data)) {
                    $favorite = $this->arrayToFavorite($data);
                } else {
                    throw new LogicException('Favorite is neither an array nor an IRI!');
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

    /**
     * @return QuoteCollection
     */
    public function getQuotes(): QuoteCollection
    {
        return $this->quotes;
    }

    /**
     * @param iterable|QuoteCollection|null $quotes
     * @return $this
     */
    public function setQuotes(?iterable $quotes): self
    {
        $this->quotes = new QuoteCollection;

        if ($quotes) {
            foreach ($quotes as $data) {
                $quote = null;

                if ($data instanceof Quote) {
                    $quote = $data;
                } else if (is_string($data)) {
                    // Convert quote IRI to a quote entity.
                    $quote = $this->iriToQuoteEntity($data);
                } else {
                    throw new LogicException('Quote is neither an array nor an IRI!');
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

    /**
     * @return CustomerCustomFieldCollection
     */
    public function getCustomFields(): CustomerCustomFieldCollection
    {
        return $this->customFields;
    }

    /**
     * @param iterable|CustomerCustomFieldCollection|null $customFields
     * @return $this
     */
    public function setCustomFields(?iterable $customFields): self
    {
        $this->customFields = new CustomerCustomFieldCollection;

        if ($customFields) {
            foreach ($customFields as $data) {
                $customField = null;

                if ($data instanceof CustomerCustomField) {
                    $customField = $data;
                } else if (is_array($data)) {
                    $customField = (new CustomerCustomField)
                        ->setCustomFieldId($data['custom_field_id'])
                        ->setCustomer($this)
                        ->setName($data['name'])
                        ->setValue($data['value']);
                } else if (is_string($data)) {
                    // Convert customField IRI to a customField entity.
                    $customField = $this->iriToCustomerCustomFieldEntity($data);
                } else {
                    throw new LogicException('Custom field is of an unexpected type!');
                }

                $this->addCustomField($customField);
            }
        }

        return $this;
    }

    public function addCustomField(CustomerCustomField $customField): self
    {
        if (!$this->customFields->contains($customField)) {
            if ($customField->getCustomer() !== $this) {
                $customField->setCustomer($this);
            }

            $this->customFields->add($customField);
        }

        return $this;
    }

    public function removeCustomField(CustomerCustomField $customField): self
    {
        if ($this->customFields->contains($customField)) {
            $customField->setCustomer(null);
            $this->customFields->removeElement($customField);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
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

    /**
     * @inheritDoc
     */
    public function toIri(): ?string
    {
        if (null === $this->getCustomerId()) {
            return null;
        }

        return '/customers/' . $this->getCustomerId();
    }

    protected function iriToOrderEntity(string $iri): Order
    {
        $id = (int)str_replace('/orders/', '', $iri);
        return (new Order)->setOrderId($id);
    }

    protected function iriToQuoteEntity(string $iri): Quote
    {
        $id = (int)str_replace('/quotes/', '', $iri);
        return (new Quote)->setQuoteId($id);
    }

    protected function iriToFavoriteEntity(string $iri): CustomerFavoriteProduct
    {
        //"/customer_favorite_products/customer=4;favoriteProduct=1"
        $id = (int)str_replace('/customer_favorite_products/', '', $iri);

        return (new CustomerFavoriteProduct)
            ->setCustomer($this)
            ->setProduct((new Product)->setProductId($id));
    }

    protected function arrayToFavorite(array $data): CustomerFavoriteProduct
    {
        $productId = null;
        $pattern = '/\/products\/(?\'product_id\'[\d]+)/';

        if (false !== preg_match($pattern, $data['favorite_product'], $matches)) {
            if (isset($matches['product_id'])) {
                $productId = (int)$matches['product_id'];
            }
        }

        if (null === $productId) {
            throw new LogicException('Could not determine product id!');
        }

        $product = (new Product)->setProductId($productId);

        return (new CustomerFavoriteProduct)
            ->setCustomer($this)
            ->setProduct($product);
    }

    protected function iriToCustomerCustomFieldEntity(string $iri): CustomerCustomField
    {
        $id = (int)str_replace('/customer_custom_fields/', '', $iri);
        return (new CustomerCustomField())->setCustomFieldId($id);
    }

    public function __clone()
    {
        $this->customFields = clone $this->customFields;
    }

    public function __destruct()
    {
        unset($this->createdAt);
        unset($this->orders);
        unset($this->productReviews);
        unset($this->favorites);
        unset($this->quotes);
        unset($this->customFields);
    }
}
