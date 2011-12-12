<?php

namespace Knp\Invoice;

use Knp\Invoice\Model\Invoice;

class Generator
{
    protected $invoice;
    protected $filename;
    protected $content = '';
    protected $generator;

    protected $template;
    protected $theme;
    protected $defaultTemplate = 'invoice';
    protected $defaultTheme    = 'Resources/views/simple_theme';

    static protected $templates = array(
        'invoice', 'list'
    );

    public function getFilename($template)
    {
        if (!$this->filename) {
            $this->filename = preg_replace('/[^a-z0-9_-]/i', '', $this->invoice->getSellerName()) .'_'. $this->invoice->getNumber().'_'.$template;
        }

        return $this->filename;
    }

    public function getTheme()
    {
        if (!$this->theme) {
            $this->theme = __DIR__.'/'.$this->defaultTheme;
        }

        return $this->theme;
    }

    public function setTheme($theme)
    {
        if (!is_string($theme)) {
            throw new \InvalidArgumentException('You need to use proper path.');
        } else if (!file_exists($theme) || !is_readable($theme)) {
            throw new \RuntimeException('Theme folder not exists and/or is not readable.');
        }

        $this->theme = $theme;
    }

    public function setInvoice(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function generate(Invoice $invoice, $template = null)
    {
        throw new \RuntimeException();
    }

    public function generateAndSave(Invoice $invoice, $filename = null, $template = null)
    {
        throw new \RuntimeException();
    }

    public function render()
    {
        return $this->content;
    }

    public function __toString()
    {
        return $this->render();
    }

    protected function checkTemplate($template)
    {
        if ($template === null) {
            $template = $this->defaultTemplate;
        }

        if (!in_array($template, self::$templates)) {
            throw new \InvalidArgumentException('Unknown template name given!');
        }

        $this->template = $template;
    }
}