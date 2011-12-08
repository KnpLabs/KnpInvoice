<?php

namespace Knp\Invoice\Generators;

use Knp\Invoice\Generator;
use Knp\Invoice\Model\Invoice;

class Twig extends Generator
{
    public function __construct()
    {
        if (class_exists('Twig_Environment', false)) {
            throw new \RuntimeException('Twig library is required!');
        }

        $this->generator = new \Twig_Environment(new \Twig_Loader_String());
    }

    public function generate(Invoice $invoice, $template = 'invoice')
    {
        $this->checkTemplate($template);

        $this->filename = preg_replace('/[^a-z0-9_-]/i', '', $invoice->getSeller()->getName()) .'_'. $invoice->getNumber().'_'.$template;
        $this->content  = $this->generator->render(
            file_get_contents(
                __DIR__.'/../'.$this->theme.'/'.$template.'.html.twig'
            ),
            array(
                'invoice' => $invoice
            )
        );
    }

    public function generateAndSave(Invoice $invoice, $filename = null, $template = 'invoice')
    {
        $this->generate($invoice, $template);

        file_put_contents($filename ?: $this->filename.'.html', $this->content);
    }
}