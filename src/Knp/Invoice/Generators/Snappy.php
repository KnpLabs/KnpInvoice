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
        if (!class_exists('Knp\Snappy\Pdf')) {
            throw new \RuntimeException('Snappy library is required!');
        }

        if (!file_exists($binLocation)) {
            throw new \RuntimeException('Binary `wkhtmltopdf` not found.');
        }

        $this->binLocation = $binLocation;

        parent::__construct();
    }

    public function generate(Invoice $invoice, $template = null)
    {
        parent::generate($invoice, $template);

        $this->_generate($this->getFilename());
    }

    public function generateAndSave(Invoice $invoice, $filename = null, $template = null)
    {
        $this->generate($invoice, $template);

        $this->save($filename);
    }

    public function __toString()
    {
        if ($this->content) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="'.$this->getFilename().'.pdf"');
        }

        return $this->render();
    }

    public function save($filename)
    {
        file_put_contents($filename ?: $this->getFilename().'.pdf', $this->content);
    }

    protected function _generate()
    {
        $snappy = new Pdf($this->binLocation);
        $this->content = $snappy->getOutputFromHtml($this->content);
    }
}
