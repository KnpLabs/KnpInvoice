<?php

namespace Knp\Invoice\Generators;

use Knp\Invoice\Generator;
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

    public function save($filename = null)
    {
        if (empty($this->content)) {
            throw new \BadFunctionCallException('You need to call `generate()` function first!');
        }

        $this->_generate($filename);
    }

    public function __toString()
    {
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