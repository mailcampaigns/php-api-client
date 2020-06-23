<?php

namespace MailCampaigns\ApiClient\Entity;

use DateTime;
use MailCampaigns\ApiClient\Collection;

class Customer implements EntityInterface
{
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
     * @var Collection\OrderCollection
     */
    protected $orders;

    /**
     * @var Collection\ProductReviewCollection
     */
    protected $productReviews;

    /**
     * @var Collection\CustomerFavoriteProductCollection
     */
    protected $favorites;

    /**
     * @var Collection\QuoteCollection
     */
    protected $quotes;

    public function __construct()
    {
        $this->orders = new Collection\OrderCollection;
        $this->productReviews = new Collection\ProductReviewCollection;
        $this->favorites = new Collection\CustomerFavoriteProductCollection();
        $this->quotes = new Collection\QuoteCollection();
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @param int $customerId
     * @return Customer
     */
    public function setCustomerId(int $customerId): self
    {
        $this->customerId = $customerId;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return Customer
     */
    public function setCreatedAt(DateTime $createdAt): self
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
     * @return Customer
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
     * @param string $customerRef
     * @return Customer
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
     * @return Customer
     */
    public function setOrigin(?string $origin): self
    {
        $this->origin = $origin;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSubscribed(): bool
    {
        return $this->isSubscribed;
    }

    /**
     * @param bool $isSubscribed
     * @return Customer
     */
    public function setIsSubscribed(bool $isSubscribed): self
    {
        $this->isSubscribed = $isSubscribed;
        return $this;
    }

    /**
     * @return bool
     */
    public function isConfirmed(): bool
    {
        return $this->isConfirmed;
    }

    /**
     * @param bool $isConfirmed
     * @return Customer
     */
    public function setIsConfirmed(bool $isConfirmed): self
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
     * @return Customer
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
     * @return Customer
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
     * @return Customer
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
     * @return Customer
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
     * @param string $middleName
     * @return Customer
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
     * @return Customer
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
     * @return Customer
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
     * @return Customer
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
     * @return Customer
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
     * @return Customer
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
     * @return Customer
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
     * @param string $addressBillingName
     * @return Customer
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
     * @param string $addressBillingStreet
     * @return Customer
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
     * @param string $addressBillingNumber
     * @return Customer
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
     * @param string $addressBillingExtension
     * @return Customer
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
     * @param string $addressBillingZipcode
     * @return Customer
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
     * @param string $addressBillingCity
     * @return Customer
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
     * @param string $addressBillingRegion
     * @return Customer
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
     * @param string $addressBillingCountry
     * @return Customer
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
     * @param string $addressShippingCompany
     * @return Customer
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
     * @param string $addressShippingName
     * @return Customer
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
     * @param string $addressShippingStreet
     * @return Customer
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
     * @param string $addressShippingNumber
     * @return Customer
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
     * @param string $addressShippingExtension
     * @return Customer
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
     * @param string $addressShippingZipcode
     * @return Customer
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
     * @param string $addressShippingCity
     * @return Customer
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
     * @param string $addressShippingRegion
     * @return Customer
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
     * @param string $addressShippingCountry
     * @return Customer
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
     * @return Customer
     */
    public function setLanguage(?string $language): self
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return Collection\OrderCollection
     */
    public function getOrders(): ?Collection\OrderCollection
    {
        return $this->orders;
    }

    /**
     * @param Collection\OrderCollection|array $orders
     * @return Customer
     */
    public function setOrders(iterable $orders): self
    {
        $this->orders = $orders;
        return $this;
    }

    /**
     * @return Collection\ProductReviewCollection
     */
    public function getProductReviews(): Collection\ProductReviewCollection
    {
        return $this->productReviews;
    }

    /**
     * @param Collection\ProductReviewCollection|array $productReviews
     * @return Customer
     */
    public function setProductReviews(iterable $productReviews): self
    {
        $this->productReviews = $productReviews;
        return $this;
    }

    /**
     * @return Collection\CustomerFavoriteProductCollection
     */
    public function getFavorites(): Collection\CustomerFavoriteProductCollection
    {
        return $this->favorites;
    }

    /**
     * @param Collection\CustomerFavoriteProductCollection|array $favorites
     * @return Customer
     */
    public function setFavorites(iterable $favorites): self
    {
        $this->favorites = $favorites;
        return $this;
    }

    /**
     * @return Collection\QuoteCollection
     */
    public function getQuotes(): Collection\QuoteCollection
    {
        return $this->quotes;
    }

    /**
     * @param Collection\QuoteCollection|array $quotes
     * @return Customer
     */
    public function setQuotes(iterable $quotes): self
    {
        $this->quotes = $quotes;
        return $this;
    }
}
