<?php

namespace Knp\Invoice\Generator;

class Twig extends Knp\Invoice\Generator
{
    public function __construct()
    {
        $this->generator = new \Twig_Environment(new \Twig_Loader_String());
    }

    public function generate($invoice)
    {
        echo $this->generator->render(
            file_get_contents(__DIR__.'/../Resources/views/'.$this->theme.'/invoice.html.twig'),
            array(
                'invoice' => $invoice
            )
        );
    }
}