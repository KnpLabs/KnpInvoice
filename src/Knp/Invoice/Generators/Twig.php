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

    public function setTemplate($template)
    {
        if (null !== $template && '.' !== substr($template, -5, 1)) {
            $template .= '.html.twig';
        }

        parent::setTemplate($template);
    }

    public function setTheme($themePath)
    {
        $defaultTheme = $this->getTheme();

        parent::setTheme($themePath);

        $this->generator->setLoader(
            new \Twig_Loader_Filesystem(array(
                $themePath,
                $defaultTheme
            ))
        );
    }

    public function generate(Invoice $invoice, $template = null)
    {
        $this->setInvoice($invoice);
        $this->setTemplate($template);

        if (!$template instanceof \Twig_Template) {
            try {
                $template = $this->generator->loadTemplate($this->getTemplate());
            } catch (\Twig_Error_Loader $e) {
                throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
            }
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
        $this->save($filename);
    }

    public function save($filename)
    {
        file_put_contents($filename ?: $this->getFilename().'.html', $this->content);
    }
}