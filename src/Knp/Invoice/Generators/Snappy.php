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

    public function generate(Invoice $invoice, $template = 'invoice')
    {
        parent::generate($invoice, $template);

        $this->_generate();
    }

    public function generateAndSave(Invoice $invoice, $filename = null, $template = 'invoice')
    {
        parent::generate($invoice, $template);

        $this->_generate($filename);
    }

    public function __toString()
    {
        if ($this->content) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="'.$this->filename.'.pdf"');
        }

        return $this->content;
    }

    protected function _generate($filename = null)
    {
        $snappy = new Pdf($this->binLocation);
        $snappy->getOutputFromHtml($this->content, $filename ?: $this->filename.'.pdf');
    }
}