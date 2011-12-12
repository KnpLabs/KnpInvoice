<?php

namespace Knp\Invoice\Generators;

use Knp\Invoice\Generator;
use Knp\Invoice\Model\Invoice;

class Twig extends Generator
{
    public function __construct()
    {
        if (!class_exists('Twig_Environment')) {
            throw new \RuntimeException('Twig library is required!');
        }

        $this->generator = new \Twig_Environment(
            new \Twig_Loader_Filesystem($this->getTheme())
        );
    }

    public function setTheme($theme)
    {
        parent::setTheme($theme);

        $this->generator->setLoader(
            new \Twig_Loader_Filesystem($theme)
        );
    }

    public function generate(Invoice $invoice, $template = null)
    {
        $this->setInvoice($invoice);

        $this->checkTemplate($template);
        $this->getFilename($template);

        if (!$template instanceof \Twig_Template) {
            $template = $this->generator->loadTemplate($this->template.'.html.twig');
        }

        $this->content = $template->render(
            array(
                'invoice' => $invoice
            )
        );
    }

    public function generateAndSave(Invoice $invoice, $filename = null, $template = null)
    {
        $this->generate($invoice, $template);

        file_put_contents($filename ?: $this->filename.'.html', $this->content);
    }
}