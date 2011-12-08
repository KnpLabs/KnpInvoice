KnpInvoice
==========

Give you an ability, to generate html/pdf invoices.

```php
<?php

require_once __DIR__.'/src/autoload.php';

$invoice = new Knp\Invoice\Model\Invoice();

$seller = new Knp\Invoice\Model\Seller();
$seller->setName('KnpLabs France');
$seller->setAddress('11 RUE KERVEGAN', 'NANTES', '44000', 'France');

$invoice->setSeller($seller);

$buyer = new Knp\Invoice\Model\Buyer();
$buyer->setName('Józef Bielawski');
$buyer->setAddress('Słowackiego 17', 'Łowicz', '99-400', 'Poland');

$invoice->setBuyer($buyer);

$coupon = new Knp\Invoice\Model\Coupon;
$coupon->setName('Christmas Holidays');
$coupon->setValue(66.6);
$invoice->setCoupon($coupon);

$invoice->setPaidAmount(100);

for ($i = 0; $i < 5; $i++) {
    $entry = new Knp\Invoice\Model\Entry();
    $entry->setDescription('Development ' . mt_rand(1, 9));
    $entry->setUnitPrice(mt_rand(100, 500));
    $entry->setQuantity(mt_rand(1, 4));

    $invoice->addEntry($entry);
}

$html = new Knp\Invoice\Generator\Twig;
$html->generate($invoice);
// $html->generate($invoice, null, 'list'); # generate just list of entries

echo $html;// $html->generateAndSave($invoice); # or use to generate and save invoice
```

Launch the Test Suite
=====================

```bash
bin/vendors.sh
```

Then just call

```bash
phpunit -c
```