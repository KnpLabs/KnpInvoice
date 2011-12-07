KnpInvoice
==========

Give you an ability, to generate html/pdf invoices.

```php
<?php

require_once __DIR__.'/src/autoload.php';

$invoice = new Knp\Invoice\Model\Invoice();

$seller = new Knp\Invoice\Model\Seller();
$seller->setName('KnpLabs');
$seller->setAddress('Słowackiego 17', 'Łowicz', '99-400');

$invoice->setSeller($seller);
$invoice->setPaidAmount(100);

for ($i = 0; $i < 5; $i++) {
    $entry = new Knp\Invoice\Model\Entry();
    $entry->setDescription('Development ' . mt_rand(1, 9));
    $entry->setUnitPrice(mt_rand(100, 500));

    $invoice->addEntry($entry);
}

$html = new Knp\Invoice\Generator\Twig;
$html->generate($invoice);
//$html->save();

echo $html;