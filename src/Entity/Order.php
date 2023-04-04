<?php

namespace MailCampaigns\ApiClient\Entity;

use DateTime;
use LogicException;
use MailCampaigns\ApiClient\Collection\OrderCustomFieldCollection;
use MailCampaigns\ApiClient\Collection\OrderProductCollection;

class Order implements EntityInterface, CustomFieldAwareEntityInterface
{
    use DateTrait;
    use DateTimeHelperTrait;

    /**
     * The unique numeric identifier for the order.
     *
     * @var int
     */
    protected $orderId;

    /**
     * Creation date and time.
     *
     * @var DateTime
     */
    protected $createdAt;

    /**
     * Date and time of last update.
     *
     * @var DateTime
     */
    protected $updatedAt;

    /**
     * Order number.
     *
     * @var string
     */
    protected $number;

    /**
     * Order status.
     *
     * @var string
     */
    protected $status;

    /**
     * Cost price of order products.
     *
     * @var float
     */
    protected $priceCost;

    /**
     * Order price excl. tax.
     *
     * @var float
     */
    protected $priceExcl;

    /**
     * Order price incl. tax.
     *
     * @var float
     */
    protected $priceIncl;

    /**
     * Shipment price excl. tax.
     *
     * @var float
     */
    protected $shipmentPriceExcl;

    /**
     * Shipment price incl. tax.
     *
     * @var float
     */
    protected $shipmentPriceIncl;

    /**
     * Total weight of order products.
     *
     * @var int
     */
    protected $weight;

    /**
     * Total volume of order products.
     *
     * @var int
     */
    protected $volume;

    /**
     * Gender of customer.
     *
     * @var string
     */
    protected $gender;

    /**
     * Birthdate of customer.
     *
     * @var DateTime
     */
    protected $birthDate;

    /**
     * Email address of the customer.
     *
     * @var string
     */
    protected $email;

    /**
     * First name of the customer.
     *
     * @var string
     */
    protected $firstName;

    /**
     * Middle name of the customer.
     *
     * @var string
     */
    protected $middleName;

    /**
     * Last name of the customer.
     *
     * @var string
     */
    protected $lastName;

    /**
     * Phone number of the customer.
     *
     * @var string
     */
    protected $phone;

    /**
     * Mobile phone number of the customer.
     *
     * @var string
     */
    protected $mobile;

    /**
     * Company name of customer.
     *
     * @var string
     */
    protected $companyName;

    /**
     * Customer company Chamber Of Commerce number.
     *
     * @var string
     */
    protected $companyCocNumber;

    /**
     * Customer company VAT number.
     *
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
     * Is the order discounted?
     *
     * @var bool
     */
    protected $isDiscounted;

    /**
     * Discount type.
     *
     * @var string
     */
    protected $discountType;

    /**
     * Amount of discount given.
     *
     * @var string
     */
    protected $discountAmount;

    /**
     * Percentage of discount given.
     *
     * @var float
     */
    protected $discountPercentage;

    /**
     * Discount coupon used.
     *
     * @var string
     */
    protected $discountCouponCode;

    /**
     * Customer's language.
     *
     * @var string
     */
    protected $language;

    /**
     * Customer reference.
     *
     * @var string
     */
    protected $customerRef;

    /**
     * @var Customer
     */
    protected $customer;

    /**
     * The products in this order.
     *
     * @var OrderProductCollection
     */
    protected $orderProducts;

    /**
     * @var Quote
     */
    protected $quote;

    /**
     * @var OrderCustomFieldCollection
     */
    protected $customFields;

    public function __construct()
    {
        $this->createdAt = new DateTime;
        $this->orderProducts = new OrderProductCollection;
        $this->isDiscounted = false;
        $this->customFields = new OrderCustomFieldCollection;
    }

    /**
     * @return int
     */
    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    /**
     * @param int|null $orderId
     * @return Order
     */
    public function setOrderId(?int $orderId): Order
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @param string|null $number
     * @return Order
     */
    public function setNumber(?string $number): Order
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     * @return Order
     */
    public function setStatus(?string $status): Order
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriceCost(): ?float
    {
        return $this->priceCost;
    }

    /**
     * @param float|null $priceCost
     * @return Order
     */
    public function setPriceCost(?float $priceCost): Order
    {
        $this->priceCost = $priceCost;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriceExcl(): ?float
    {
        return $this->priceExcl;
    }

    /**
     * @param float|null $priceExcl
     * @return Order
     */
    public function setPriceExcl(?float $priceExcl): Order
    {
        $this->priceExcl = $priceExcl;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriceIncl(): ?float
    {
        return $this->priceIncl;
    }

    /**
     * @param float|null $priceIncl
     * @return Order
     */
    public function setPriceIncl(?float $priceIncl): Order
    {
        $this->priceIncl = $priceIncl;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getShipmentPriceExcl(): ?float
    {
        return $this->shipmentPriceExcl;
    }

    /**
     * @param float|null $shipmentPriceExcl
     * @return Order
     */
    public function setShipmentPriceExcl(?float $shipmentPriceExcl): Order
    {
        $this->shipmentPriceExcl = $shipmentPriceExcl;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getShipmentPriceIncl(): ?float
    {
        return $this->shipmentPriceIncl;
    }

    /**
     * @param float|null $shipmentPriceIncl
     * @return Order
     */
    public function setShipmentPriceIncl(?float $shipmentPriceIncl): Order
    {
        $this->shipmentPriceIncl = $shipmentPriceIncl;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getWeight(): ?int
    {
        return $this->weight;
    }

    /**
     * @param int|null $weight
     * @return Order
     */
    public function setWeight(?int $weight): Order
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getVolume(): ?int
    {
        return $this->volume;
    }

    /**
     * @param int|null $volume
     * @return Order
     */
    public function setVolume(?int $volume): Order
    {
        $this->volume = $volume;
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
     * @return Order
     */
    public function setGender(?string $gender): Order
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
     * @return Order
     */
    public function setBirthDate(?DateTime $birthDate): Order
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Order
     */
    public function setEmail(string $email): Order
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Order
     */
    public function setFirstName(string $firstName): Order
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * @param string|null $middleName
     * @return Order
     */
    public function setMiddleName(?string $middleName): Order
    {
        $this->middleName = $middleName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Order
     */
    public function setLastName(string $lastName): Order
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
     * @return Order
     */
    public function setPhone(?string $phone): Order
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
     * @return Order
     */
    public function setMobile(?string $mobile): Order
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
     * @return Order
     */
    public function setCompanyName(?string $companyName): Order
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
     * @return Order
     */
    public function setCompanyCocNumber(?string $companyCocNumber): Order
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
     * @return Order
     */
    public function setCompanyVatNumber(?string $companyVatNumber): Order
    {
        $this->companyVatNumber = $companyVatNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressBillingName(): ?string
    {
        return $this->addressBillingName;
    }

    /**
     * @param string|null $addressBillingName
     * @return Order
     */
    public function setAddressBillingName(?string $addressBillingName): Order
    {
        $this->addressBillingName = $addressBillingName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressBillingStreet(): ?string
    {
        return $this->addressBillingStreet;
    }

    /**
     * @param string|null $addressBillingStreet
     * @return Order
     */
    public function setAddressBillingStreet(?string $addressBillingStreet): Order
    {
        $this->addressBillingStreet = $addressBillingStreet;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressBillingNumber(): ?string
    {
        return $this->addressBillingNumber;
    }

    /**
     * @param string|null $addressBillingNumber
     * @return Order
     */
    public function setAddressBillingNumber(?string $addressBillingNumber): Order
    {
        $this->addressBillingNumber = $addressBillingNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressBillingExtension(): ?string
    {
        return $this->addressBillingExtension;
    }

    /**
     * @param string|null $addressBillingExtension
     * @return Order
     */
    public function setAddressBillingExtension(?string $addressBillingExtension): Order
    {
        $this->addressBillingExtension = $addressBillingExtension;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressBillingZipcode(): ?string
    {
        return $this->addressBillingZipcode;
    }

    /**
     * @param string|null $addressBillingZipcode
     * @return Order
     */
    public function setAddressBillingZipcode(?string $addressBillingZipcode): Order
    {
        $this->addressBillingZipcode = $addressBillingZipcode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressBillingCity(): ?string
    {
        return $this->addressBillingCity;
    }

    /**
     * @param string|null $addressBillingCity
     * @return Order
     */
    public function setAddressBillingCity(?string $addressBillingCity): Order
    {
        $this->addressBillingCity = $addressBillingCity;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressBillingRegion(): ?string
    {
        return $this->addressBillingRegion;
    }

    /**
     * @param string|null $addressBillingRegion
     * @return Order
     */
    public function setAddressBillingRegion(?string $addressBillingRegion): Order
    {
        $this->addressBillingRegion = $addressBillingRegion;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressBillingCountry(): ?string
    {
        return $this->addressBillingCountry;
    }

    /**
     * @param string|null $addressBillingCountry
     * @return Order
     */
    public function setAddressBillingCountry(?string $addressBillingCountry): Order
    {
        $this->addressBillingCountry = $addressBillingCountry;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressShippingCompany(): ?string
    {
        return $this->addressShippingCompany;
    }

    /**
     * @param string|null $addressShippingCompany
     * @return Order
     */
    public function setAddressShippingCompany(?string $addressShippingCompany): Order
    {
        $this->addressShippingCompany = $addressShippingCompany;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressShippingName(): ?string
    {
        return $this->addressShippingName;
    }

    /**
     * @param string|null $addressShippingName
     * @return Order
     */
    public function setAddressShippingName(?string $addressShippingName): Order
    {
        $this->addressShippingName = $addressShippingName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressShippingStreet(): ?string
    {
        return $this->addressShippingStreet;
    }

    /**
     * @param string|null $addressShippingStreet
     * @return Order
     */
    public function setAddressShippingStreet(?string $addressShippingStreet): Order
    {
        $this->addressShippingStreet = $addressShippingStreet;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressShippingNumber(): ?string
    {
        return $this->addressShippingNumber;
    }

    /**
     * @param string|null $addressShippingNumber
     * @return Order
     */
    public function setAddressShippingNumber(?string $addressShippingNumber): Order
    {
        $this->addressShippingNumber = $addressShippingNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressShippingExtension(): ?string
    {
        return $this->addressShippingExtension;
    }

    /**
     * @param string|null $addressShippingExtension
     * @return Order
     */
    public function setAddressShippingExtension(?string $addressShippingExtension): Order
    {
        $this->addressShippingExtension = $addressShippingExtension;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressShippingZipcode(): ?string
    {
        return $this->addressShippingZipcode;
    }

    /**
     * @param string|null $addressShippingZipcode
     * @return Order
     */
    public function setAddressShippingZipcode(?string $addressShippingZipcode): Order
    {
        $this->addressShippingZipcode = $addressShippingZipcode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressShippingCity(): ?string
    {
        return $this->addressShippingCity;
    }

    /**
     * @param string|null $addressShippingCity
     * @return Order
     */
    public function setAddressShippingCity(?string $addressShippingCity): Order
    {
        $this->addressShippingCity = $addressShippingCity;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressShippingRegion(): ?string
    {
        return $this->addressShippingRegion;
    }

    /**
     * @param string|null $addressShippingRegion
     * @return Order
     */
    public function setAddressShippingRegion(?string $addressShippingRegion): Order
    {
        $this->addressShippingRegion = $addressShippingRegion;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressShippingCountry(): ?string
    {
        return $this->addressShippingCountry;
    }

    /**
     * @param string|null $addressShippingCountry
     * @return Order
     */
    public function setAddressShippingCountry(?string $addressShippingCountry): Order
    {
        $this->addressShippingCountry = $addressShippingCountry;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsDiscounted(): bool
    {
        return $this->isDiscounted === true;
    }

    /**
     * @param bool $isDiscounted
     * @return Order
     */
    public function setIsDiscounted(bool $isDiscounted): Order
    {
        $this->isDiscounted = $isDiscounted;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDiscountType(): ?string
    {
        return $this->discountType;
    }

    /**
     * @param string|null $discountType
     * @return Order
     */
    public function setDiscountType(?string $discountType): Order
    {
        $this->discountType = $discountType;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getDiscountAmount(): ?float
    {
        return $this->discountAmount;
    }

    /**
     * @param float|null $discountAmount
     * @return Order
     */
    public function setDiscountAmount(?float $discountAmount): Order
    {
        $this->discountAmount = $discountAmount;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getDiscountPercentage(): ?float
    {
        return $this->discountPercentage;
    }

    /**
     * @param float|null $discountPercentage
     * @return Order
     */
    public function setDiscountPercentage(?float $discountPercentage): Order
    {
        $this->discountPercentage = $discountPercentage;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDiscountCouponCode(): ?string
    {
        return $this->discountCouponCode;
    }

    /**
     * @param string|null $discountCouponCode
     * @return Order
     */
    public function setDiscountCouponCode(?string $discountCouponCode): Order
    {
        $this->discountCouponCode = $discountCouponCode;
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
     * @return Order
     */
    public function setLanguage(?string $language): Order
    {
        $this->language = $language;
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
     * @return Order
     */
    public function setCustomerRef(?string $customerRef): Order
    {
        $this->customerRef = $customerRef;
        return $this;
    }

    /**
     * @return Customer|null
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer|null $customer
     * @return Order
     */
    public function setCustomer(?Customer $customer): Order
    {
        $this->customer = $customer;
        return $this;
    }

    public function getOrderProducts(): OrderProductCollection
    {
        return $this->orderProducts;
    }

    /**
     * @param iterable|OrderProductCollection|null $orderProducts
     * @return Order
     */
    public function setOrderProducts(?iterable $orderProducts): Order
    {
        $this->orderProducts = new OrderProductCollection;

        if ($orderProducts) {
            foreach ($orderProducts as $data) {
                $orderProduct = null;

                if ($data instanceof OrderProduct) {
                    $orderProduct = $data;
                } else if (is_array($data)) {
                    $orderProductId = null;
                    $orderProduct = new OrderProduct;

                    if (isset($data['@id']) && is_string($data['@id'])) {
                        if (false !== preg_match('/\/order_products\/(\d+)/', $data['@id'], $matches)) {
                            if (isset($matches[1])) {
                                $orderProductId = (int)$matches[1];
                            }
                        }
                    } else if (isset($data['order_id'])) {
                        $orderProductId = (int)$data['order_product_id'];
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
                    throw new LogicException('Order product is neither an array nor an entity!');
                }

                $this->addOrderProduct($orderProduct);
            }
        }

        return $this;
    }

    /**
     * @param OrderProduct $orderProduct
     * @return $this
     */
    public function addOrderProduct(OrderProduct $orderProduct): Order
    {
        if (!$this->orderProducts->contains($orderProduct)) {
            if ($orderProduct->getOrder() !== $this) {
                $orderProduct->setOrder($this);
            }

            $this->orderProducts->add($orderProduct);
        }

        return $this;
    }

    /**
     * @param OrderProduct $orderProduct
     * @return $this
     */
    public function removeOrderProduct(OrderProduct $orderProduct): Order
    {
        if ($this->orderProducts->contains($orderProduct)) {
            $orderProduct->unsetOrder();
            $this->orderProducts->removeElement($orderProduct);
        }

        return $this;
    }

    protected function productIriToEntity(string $iri): ?Product
    {
        if (false !== preg_match('/\/products\/(\d+)/', $iri, $matches)) {
            if (isset($matches[1])) {
                return (new Product)->setProductId((int)$matches[1]);
            }
        }

        return null;
    }

    /**
     * @return Quote|null
     */
    public function getQuote(): ?Quote
    {
        return $this->quote;
    }

    /**
     * @param Quote|null $quote
     * @return Order
     */
    public function setQuote(?Quote $quote): Order
    {
        $this->quote = $quote;
        return $this;
    }

    /**
     * @return OrderCustomFieldCollection
     */
    public function getCustomFields(): OrderCustomFieldCollection
    {
        return $this->customFields;
    }

    /**
     * @param iterable|OrderCustomFieldCollection|null $customFields
     * @return $this
     */
    public function setCustomFields(?iterable $customFields): self
    {
        $this->customFields = new OrderCustomFieldCollection;

        if ($customFields) {
            foreach ($customFields as $data) {
                $customField = null;

                if ($data instanceof OrderCustomField) {
                    $customField = $data;
                } else if (is_array($data)) {
                    $customField = (new OrderCustomField)
                        ->setCustomFieldId($data['custom_field_id'])
                        ->setOrder($this)
                        ->setName($data['name'])
                        ->setValue($data['value']);
                } else if (is_string($data)) {
                    // Convert customField IRI to a customField entity.
                    $customField = $this->iriToOrderCustomFieldEntity($data);
                } else {
                    throw new LogicException('Custom field is of an unexpected type!');
                }

                $this->addCustomField($customField);
            }
        }

        return $this;
    }

    /**
     * @param OrderCustomField $customField
     * @return $this
     */
    public function addCustomField(CustomFieldInterface $customField): CustomFieldAwareEntityInterface
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

    /**
     * @param OrderCustomField $customField
     * @return $this
     */
    public function removeCustomField(CustomFieldInterface $customField): CustomFieldAwareEntityInterface
    {
        assert($customField instanceof OrderCustomField);

        if ($this->customFields->contains($customField)) {
            $customField->setOrder(null);
            $this->customFields->removeElement($customField);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toIri(): ?string
    {
        if (null === $this->getOrderId()) {
            return null;
        }

        return '/orders/' . $this->getOrderId();
    }

    /**
     * @inheritDoc
     */
    public function toArray(?string $operation = null, ?bool $isRoot = false): array
    {
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

    protected function iriToOrderCustomFieldEntity(string $iri): OrderCustomField
    {
        $id = (int)str_replace('/order_custom_fields/', '', $iri);
        return (new OrderCustomField())->setCustomFieldId($id);
    }

    /**
     * @return OrderCustomField
     */
    public function getNewCustomField(): CustomFieldInterface
    {
        return new OrderCustomField();
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
        unset($this->customer);
        unset($this->orderProducts);
        unset($this->quote);
        unset($this->customFields);
    }
}
