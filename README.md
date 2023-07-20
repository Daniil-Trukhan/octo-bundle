# OctoBundle

## Installation

### Install the package

```bash
composer req wildan99/octo-bundle
```

### Add to config/bundles.php

```php
Daniil\OctoBundle\OctoBundle::class => ['all' => true],
```

### Add next lines to your .env file

```dotenv
###> octo ###
OCTO_SHOP_ID=<get it in OCTO>
OCTO_SECRET=<get it in OCTO>
OCTO_NOTIFY_URL=
OCTO_RETURN_URL=
OCTO_TEST=true
OCTO_AUTO_CAPTURE=true
###< octo ###
```

## How to use
You need to use this service in construct method of class
### Example of simple using
```php
class MyClass 
{
    public function __construct(private \Daniil\OctoBundle\Service\Client $client) 
    {
    }
    
    public function prepare(): void
    {
        $this->client->prepare(new PrepareRequest(shopTransactionId: 'test', sum: 1000, currency: Currency::UZS, description: ''))
    }
}
````