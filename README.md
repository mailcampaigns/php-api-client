![MailCampaigns](https://www.mailcampaigns.nl/images/logo.svg)

![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/mailcampaigns/api-client)
![GitHub](https://img.shields.io/github/license/mailcampaigns/php-api-client)

MailCampaigns PHP API client
============================

The MailCampaigns PHP Api client provides an easy way to communicate with the MailCampaigns RESTful API (v3).

Installation
------------
Install with Composer:

```json
composer require mailcampaigns/api-client
```

Usage
-----
You'll need the Api url, client key and secret which can be obtained by logging in to your MailCampaigns account (on the Custom Connector page).

*Note: This section will be updated soon!*

```PHP
use MailCampaigns\ApiClient\ApiClient;
use MailCampaigns\ApiClient\Entity\Customer;

$apiClient = ApiClient::create('<url>', '<client_key>', '<client_secret>');
$customerApi = $apiClient->getCustomerApi();

// Example 1 - Retrieve a customer by id:
$customer = $customerApi->getById(1234);

// Example 2 - Retrieve first three pages of customers:
for ($page = 1; $page <= 3; $page++) {
    $customers = $customerApi->getCollection($page);

    /** @var Customer $customer */
    foreach ($customers as $customer) {
        // Use customer as an entity (object):
        print $customer->getEmail() . PHP_EOL;

        // Output customer as an array.
        print_r($customer->toArray());
    }
}

// Example 3 - Create a new customer:
$customerApi->create(
    (new Customer)
        ->setCustomerRef('CUST-8539')
        ->setEmail('johndoe@hotmail.com')
        ->setFirstName('John')
        ->setLastName('Doe')
        ->setGender('male')
);

// Example 4 - Update a customer:
$customerApi->update($customer);

// Example 5 - Get customer by customer reference:
$customer = $customerApi->getByCustomerRef('CUST-8539');

// Example 6 - Get customer by email address:
$customer = $customerApi->getByEmail('bob@hotmail.com');

// Example 7 - Delete a customer by id.
$customerApi->deleteById(1234);
```

Using custom fields:

```PHP
use MailCampaigns\ApiClient\ApiClient;
use MailCampaigns\ApiClient\Entity\Customer;
use MailCampaigns\ApiClient\Entity\CustomerCustomField;

$apiClient = ApiClient::create('<url>', '<client_key>', '<client_secret>');

$customerCustomFieldApi = $apiClient->getCustomerCustomFieldApi();

// Example 1: Add a new custom field to an existing customer.
$customer = (new Customer)->setCustomerId(6); // Or load an actual customer first.

$customField = (new CustomerCustomField)
    ->setName('een_extra_veld_2')
    ->setValue('Waarde voor extra veld 2.')
    ->setCustomer($customer);

$createdCustomField = $customerCustomFieldApi->create($customField);

// The created custom field will contain the generated id.
print $createdCustomField->getCustomFieldId();

// Example 2: Update an existing custom field.
$customField
    ->setUpdatedAt(new DateTime())
    ->setValue('Een aangepaste waarde.');

$updatedCustomField = $customerCustomFieldApi->update($customField);

// Example 4: Delete a custom field by its id.
$customerCustomFieldApi->deleteById(123);
```

Resources
---------
 * [API v3 Documentation](https://api-v3.docs.mailcampaigns.io)
 * [GitHub](https://github.com/mailcampaigns/php-api-client)
