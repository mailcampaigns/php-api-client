<?php

declare(strict_types=1);

namespace MailCampaigns\ApiClient\Entity;

use DateTime;
use DateTimeInterface;
use LogicException;
use MailCampaigns\ApiClient\Collection\OrderCustomFieldCollection;
use MailCampaigns\ApiClient\Collection\OrderProductCollection;
use MailCampaigns\ApiClient\ToJsonTrait;

class Order implements EntityInterface, CustomFieldAwareEntityInterface
{
    use DateTrait;
    use DateTimeHelperTrait;
    use ToJsonTrait;

    public function __construct(
        private ?int $orderId = null,
        private ?string $number = null,
        private ?string $status = null,
        private ?float $priceCost = null,
        private ?float $priceExcl = null,
        private ?float $priceIncl = null,
        private ?float $shipmentPriceExcl = null,
        private ?float $shipmentPriceIncl = null,
        private ?int $weight = null,
        private ?int $volume = null,
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
        private ?bool $isDiscounted = false,
        private ?string $discountType = null,
        private ?float $discountAmount = null,
        private ?float $discountPercentage = null,
        private ?string $discountCouponCode = null,
        private ?string $language = null,
        private ?string $customerRef = null,
        private ?Customer $customer = null,
        private ?Quote $quote = null,
        private ?OrderProductCollection $orderProducts = new OrderProductCollection(),
        private ?OrderCustomFieldCollection $customFields = new OrderCustomFieldCollection(),
    ) {
        $this->createdAt = new DateTime();
    }

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function setOrderId(?int $orderId): self
    {
        $this->orderId = $orderId;
        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getPriceCost(): ?float
    {
        return $this->priceCost;
    }

    public function setPriceCost(?float $priceCost): self
    {
        $this->priceCost = $priceCost;
        return $this;
    }

    public function getPriceExcl(): ?float
    {
        return $this->priceExcl;
    }

    public function setPriceExcl(?float $priceExcl): self
    {
        $this->priceExcl = $priceExcl;
        return $this;
    }

    public function getPriceIncl(): ?float
    {
        return $this->priceIncl;
    }

    public function setPriceIncl(?float $priceIncl): self
    {
        $this->priceIncl = $priceIncl;
        return $this;
    }

    public function getShipmentPriceExcl(): ?float
    {
        return $this->shipmentPriceExcl;
    }

    public function setShipmentPriceExcl(?float $shipmentPriceExcl): self
    {
        $this->shipmentPriceExcl = $shipmentPriceExcl;
        return $this;
    }

    public function getShipmentPriceIncl(): ?float
    {
        return $this->shipmentPriceIncl;
    }

    public function setShipmentPriceIncl(?float $shipmentPriceIncl): self
    {
        $this->shipmentPriceIncl = $shipmentPriceIncl;
        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): self
    {
        $this->weight = $weight;
        return $this;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(?int $volume): self
    {
        $this->volume = $volume;
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

    public function setBirthDate(?DateTime $birthDate): self
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getFirstName(): ?string
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

    public function getLastName(): ?string
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

    public function getIsDiscounted(): bool
    {
        return $this->isDiscounted === true;
    }

    public function setIsDiscounted(bool $isDiscounted): self
    {
        $this->isDiscounted = $isDiscounted;
        return $this;
    }

    public function getDiscountType(): ?string
    {
        return $this->discountType;
    }

    public function setDiscountType(?string $discountType): self
    {
        $this->discountType = $discountType;
        return $this;
    }

    public function getDiscountAmount(): ?float
    {
        return $this->discountAmount;
    }

    public function setDiscountAmount(?float $discountAmount): self
    {
        $this->discountAmount = $discountAmount;
        return $this;
    }

    public function getDiscountPercentage(): ?float
    {
        return $this->discountPercentage;
    }

    public function setDiscountPercentage(?float $discountPercentage): self
    {
        $this->discountPercentage = $discountPercentage;
        return $this;
    }

    public function getDiscountCouponCode(): ?string
    {
        return $this->discountCouponCode;
    }

    public function setDiscountCouponCode(?string $discountCouponCode): self
    {
        $this->discountCouponCode = $discountCouponCode;
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

    public function getCustomerRef(): ?string
    {
        return $this->customerRef;
    }

    public function setCustomerRef(?string $customerRef): self
    {
        $this->customerRef = $customerRef;
        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;
        return $this;
    }

    public function getOrderProducts(): OrderProductCollection
    {
        return $this->orderProducts;
    }

    public function setOrderProducts(?iterable $orderProducts): self
    {
        $this->orderProducts = new OrderProductCollection();

        if ($orderProducts) {
            foreach ($orderProducts as $data) {
                $orderProduct = null;

                if ($data instanceof OrderProduct) {
                    $orderProduct = $data;
                } else {
                    if (is_array($data)) {
                        $orderProductId = null;
                        $orderProduct = new OrderProduct();

                        if (isset($data['@id']) && is_string($data['@id'])) {
                            $pregMatchRes = preg_match(
                                '/\/order_products\/(\d+)/',
                                $data['@id'],
                                $matches
                            );

                            if (false !== $pregMatchRes) {
                                if (isset($matches[1])) {
                                    $orderProductId = (int)$matches[1];
                                }
                            }
                        } else {
                            if (isset($data['order_id'])) {
                                $orderProductId = (int)$data['order_product_id'];
                            }
                        }

                        $orderProduct
                            ->setOrderProductId($orderProductId)
                            ->setSupplierTitle($data['supplier_title'])
                            ->setBrandTitle($data['brand_title'])
                            ->setProductTitle($data['product_title'])
                            ->setTaxRate($data['tax_rate'])
                            ->setQuantityOrdered($data['quantity_ordered'])
                            ->setQuantityInvoiced($data['quantity_invoiced'])
                            ->setQuantityShipped($data['quantity_shipped'])
                            ->setQuantityRefunded($data['quantity_refunded'])
                            ->setQuantityReturned($data['quantity_returned'])
                            ->setArticleCode($data['article_code'])
                            ->setEan($data['ean'])
                            ->setSku($data['sku'])
                            ->setQuantity($data['quantity'])
                            ->setPriceCost($data['price_cost'])
                            ->setBasePriceExcl($data['base_price_excl'])
                            ->setBasePriceIncl($data['base_price_incl'])
                            ->setPriceExcl($data['price_excl'])
                            ->setPriceIncl($data['price_incl'])
                            ->setDiscountExcl($data['discount_excl'])
                            ->setDiscountIncl($data['discount_incl']);

                        // If a product is linked to this order row (order product) add
                        // product entity based on the product IRI.
                        if ($data['product']) {
                            $orderProduct->setProduct(
                                $this->productIriToEntity($data['product'])
                            );
                        }
                    } else {
                        throw new LogicException(
                            'Order product is neither an array nor an entity!'
                        );
                    }
                }

                $this->addOrderProduct($orderProduct);
            }
        }

        return $this;
    }

    public function addOrderProduct(OrderProduct $orderProduct): self
    {
        if (!$this->orderProducts->contains($orderProduct)) {
            if ($orderProduct->getOrder() !== $this) {
                $orderProduct->setOrder($this);
            }

            $this->orderProducts->add($orderProduct);
        }

        return $this;
    }

    public function removeOrderProduct(OrderProduct $orderProduct): self
    {
        if ($this->orderProducts->contains($orderProduct)) {
            $orderProduct->unsetOrder();
            $this->orderProducts->removeElement($orderProduct);
        }

        return $this;
    }

    private function productIriToEntity(string $iri): ?Product
    {
        if (false !== preg_match('/\/products\/(\d+)/', $iri, $matches)) {
            if (isset($matches[1])) {
                return (new Product())->setProductId((int)$matches[1]);
            }
        }

        return null;
    }

    public function getQuote(): ?Quote
    {
        return $this->quote;
    }

    public function setQuote(?Quote $quote): self
    {
        $this->quote = $quote;
        return $this;
    }

    public function getCustomFields(): OrderCustomFieldCollection
    {
        return $this->customFields;
    }

    public function setCustomFields(?iterable $customFields): self
    {
        $this->customFields = new OrderCustomFieldCollection();

        if ($customFields) {
            foreach ($customFields as $data) {
                $customField = null;

                if ($data instanceof OrderCustomField) {
                    $customField = $data;
                } else {
                    if (is_array($data)) {
                        $customField = (new OrderCustomField())
                            ->setCustomFieldId($data['custom_field_id'])
                            ->setOrder($this)
                            ->setName($data['name'])
                            ->setValue($data['value']);
                    } else {
                        if (is_string($data)) {
                            // Convert customField IRI to a customField entity.
                            $customField = $this->iriToOrderCustomFieldEntity($data);
                        } else {
                            throw new LogicException(
                                'Custom field is of an unexpected type!'
                            );
                        }
                    }
                }

                $this->addCustomField($customField);
            }
        }

        return $this;
    }

    public function addCustomField(CustomFieldInterface $customField): self
    {
        assert($customField instanceof OrderCustomField);

        if (!$this->customFields->contains($customField)) {
            if ($customField->getOrder() !== $this) {
                $customField->setOrder($this);
            }

            $this->customFields->add($customField);
        }

        return $this;
    }

    public function removeCustomField(CustomFieldInterface $customField): self
    {
        assert($customField instanceof OrderCustomField);

        if ($this->customFields->contains($customField)) {
            $customField->setOrder(null);
            $this->customFields->removeElement($customField);
        }

        return $this;
    }

    public function toIri(): ?string
    {
        if (null === $this->getOrderId()) {
            return null;
        }

        return '/orders/' . $this->getOrderId();
    }

    public function toArray(
        ?string $operation = null,
        ?bool $isRoot = false
    ): array {
        return [
            'order_id' => $this->getOrderId(),
            'created_at' => $this->dtToString($this->getCreatedAt()),
            'updated_at' => $this->dtToString($this->getUpdatedAt()),
            'number' => $this->getNumber(),
            'status' => $this->getStatus(),
            'price_cost' => $this->getPriceCost(),
            'price_excl' => $this->getPriceExcl(),
            'price_incl' => $this->getPriceIncl(),
            'shipment_price_excl' => $this->getShipmentPriceExcl(),
            'shipment_price_incl' => $this->getShipmentPriceIncl(),
            'weight' => $this->getWeight(),
            'volume' => $this->getVolume(),
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
            'is_discounted' => $this->getIsDiscounted(),
            'discount_type' => $this->getDiscountType(),
            'discount_amount' => $this->getDiscountAmount(),
            'discount_percentage' => $this->getDiscountPercentage(),
            'discount_coupon_code' => $this->getDiscountCouponCode(),
            'language' => $this->getLanguage(),
            'customer_ref' => $this->getCustomerRef(),
            'customer' => $this->getCustomerIri(),
            'order_products' => $this->getOrderProducts()->toArray($operation),
            'quote' => $this->getQuoteIri(),
            'custom_fields' => $this->getCustomFields()->toArray($operation)
        ];
    }

    public function getCustomerIri(): ?string
    {
        if (!$this->getCustomer() instanceof Customer) {
            return null;
        }

        return $this->getCustomer()->toIri();
    }

    public function getQuoteIri(): ?string
    {
        if (!$this->getQuote() instanceof Quote) {
            return null;
        }

        return $this->getQuote()->toIri();
    }

    private function iriToOrderCustomFieldEntity(string $iri): OrderCustomField
    {
        $id = (int)str_replace('/order_custom_fields/', '', $iri);
        return (new OrderCustomField())->setCustomFieldId($id);
    }

    public function getNewCustomField(): CustomFieldInterface
    {
        return new OrderCustomField();
    }

    public function __clone()
    {
        if ($this->createdAt !== null) {
            $this->createdAt = clone $this->createdAt;
        }

        if ($this->updatedAt !== null) {
            $this->updatedAt = clone $this->updatedAt;
        }

        if ($this->birthDate !== null) {
            $this->birthDate = clone $this->birthDate;
        }

        if ($this->customer !== null) {
            $this->customer = clone $this->customer;
        }

        if ($this->orderProducts !== null) {
            $this->orderProducts = clone $this->orderProducts;
        }

        if ($this->quote !== null) {
            $this->quote = clone $this->quote;
        }

        if ($this->customFields !== null) {
            $this->customFields = clone $this->customFields;
        }
    }

    public function __destruct()
    {
        unset($this->createdAt);
        unset($this->updatedAt);
        unset($this->birthDate);
        unset($this->customer);
        unset($this->orderProducts);
        unset($this->quote);
        unset($this->customFields);
    }
}
