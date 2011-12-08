<?php

namespace Knp\Invoice\Generators;

use Knp\Invoice\Generator;

class Twig extends Generator
{
    public function __construct()
    {
        if (class_exists('Twig_Environment', false)) {
            throw new \RuntimeException();
        }

        $this->generator = new \Twig_Environment(new \Twig_Loader_String());
    }

    public function generate($invoice)
    {
        $this->filename = $invoice->getNumber();
        $this->content  = $this->generator->render(
            file_get_contents(__DIR__.'/../'.$this->theme.'/invoice.html.twig'),
            array(
                'invoice' => $invoice
            )
        );
    }

    public function save($filename = null)
    {
        file_put_contents($filename ?: $this->filename.'.html', $this->content);
    }
}