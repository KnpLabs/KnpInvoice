KnpInvoice
==========

Give you an ability, to generate html/pdf invoices.

```php
<?php

// Setup Symfony2 based autoloader
require_once __DIR__.'/src/autoload.php';

// Set up Invoice model (required to do anything)
$invoice = new Knp\Invoice\Model\Invoice();

// Lets set up seller data now
$seller = new Knp\Invoice\Model\Seller();
$seller->setName('KnpLabs France');
// Add address: street, city, zip-code, country
$seller->setAddress('11 RUE KERVEGAN', 'NANTES', '44000', 'France');
// Address of logotype image
// $seller->setLogo('images/logo.png');

// Now add seller to invoice
$invoice->setSeller($seller);

// Lets set up buyer data now
$buyer = new Knp\Invoice\Model\Buyer();
$buyer->setName('Marek Nowak');
// Add address: street, city, zip-code, country
$buyer->setAddress('Kozia 5', 'Kozia Wólka', '00-666', 'Poland');

// Now add buyer to invoice
$invoice->setBuyer($buyer);

/*
// Customer has coupon ? Let's add it
$coupon = new Knp\Invoice\Model\Coupon;
$coupon->setName('Christmas Holidays');
$coupon->setValue(66.6);
// Coupon will expire at given date
// $coupon->setExpireAt('2011-12-25');
// Now add coupon to invoice
$invoice->setCoupon($coupon);
*/

// Customer already paid something ? Let's add this
$invoice->setPaidAmount(100);

// Now let's setup taxes
$taxTPS = new Knp\Invoice\Model\Tax;
$taxTPS->setName('TPS');
$taxTPS->setValue(5);

$taxTVQ = new Knp\Invoice\Model\Tax('TVQ', 8);

// Here we setup and add some random entries to invoice
for ($i = 0; $i < 5; $i++) {
    $entry = new Knp\Invoice\Model\Entry();
    $entry->setDescription('Development ' . mt_rand(1, 9));
    // Netto price per unit
    $entry->setUnitPrice(mt_rand(100, 500));
    // Quantity of given entry
    $entry->setQuantity(mt_rand(1, 4));

    // Entry can have up to two taxes added (i.e. Canada)
    // If no taxes add by using this method, there will be used 0% default one
    $entry->addTax($taxTPS);
    $entry->addTax($taxTVQ);

    // And let's add entry to invoice
    $invoice->addEntry($entry);
}

// Let's select generator
// $content = new Knp\Invoice\Generators\Snappy;
$content = new Knp\Invoice\Generators\Twig;
$content->generate($invoice);
// $html->generateAndSave($invoice); # You can generate and save invoice instead of returning to browser
// or
// $content->generate($invoice, null, 'list'); # generate just list of entries

echo $content;
```

Launch the Test Suite
=====================

```bash
bin/vendors.sh
```

Then just call

```bash
phpunit
```

ToDo
====

https://trello.com/board/knpinvoicebundle/4ec25be9e900feed372d9661