<?php

namespace Knp\Invoice\Generators;

use Knp\Invoice\Generator;
use Knp\Invoice\Model\Invoice;
use Knp\Snappy\Pdf;

class Snappy extends Twig
{
    protected $binLocation;

    public function __construct($binLocation = '/usr/local/bin/wkhtmltopdf')
    {
        if (!file_exists('/usr/local/bin/wkhtmltopdf')) {
            throw new \RuntimeException();
        }

        $this->binLocation = $binLocation;

        parent::__construct();
    }

    public function generate(Invoice $invoice)
    {
        parent::generate($invoice);

        $this->_generate();
    }

    public function generateAndSave(Invoice $invoice, $filename = null)
    {
        parent::generate($invoice);

        $this->_generate($filename);
    }

    public function __toString()
    {
        if (!$this->content) {
            throw new \RuntimeException('You need to call `generate()` function first!');
        }

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="'.$this->filename.'.pdf"');

        return $this->content;
    }

    protected function _generate($filename = null)
    {
        $snappy = new Pdf($this->binLocation);
        $snappy->getOutputFromHtml($this->content, $filename ?: $this->filename.'.pdf');
    }
}