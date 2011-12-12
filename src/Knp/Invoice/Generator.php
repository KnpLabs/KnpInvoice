<?php

namespace Knp\Invoice;

use Knp\Invoice\Model\Invoice;

class Generator
{
    /**
     * @var Knp\Invoice\Model\Invoice
     */
    protected $invoice;

    /**
     * @var mixed
     */
    protected $content = '';

    /**
     * @var object
     */
    protected $generator;

    /**
     * @var string
     */
    protected $filename;

    /**
     * @var string
     */
    protected $template;

    /**
     * @var string
     */
    protected $themePath;

    /**
     * @var string
     */
    protected $defaultTemplate = 'invoice.html.twig';

    /**
     * @var string
     */
    protected $defaultTheme    = 'Resources/views/simple_theme';

    public function getFilename()
    {
        if (!$this->filename) {
            $this->filename = preg_replace('/[^a-z0-9_-]/i', '', $this->invoice->getSellerName()) .'_'. $this->invoice->getNumber().'_'.$this->getTemplate();
        }

        return $this->filename;
    }

    public function getTemplate()
    {
        return $this->template ?: $this->defaultTemplate;
    }

    public function getTheme()
    {
        return $this->themePath ?: __DIR__.'/'.$this->defaultTheme;
    }

    public function setTemplate($template)
    {
        if ($template) {
            $this->setTheme(dirname($template));
        }

        $this->template = $template;
    }

    public function setTheme($themePath)
    {
        if (!$themePath) {
            $themePath = $this->defaultTheme;
        }

        $this->_checkFileOrDir($themePath);

        $this->themePath = $themePath;
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

    protected function _checkFileOrDir($fileOrPath)
    {
        if (!is_string($fileOrPath)) {
            throw new \InvalidArgumentException(sprintf('You need to use proper path. Used: "%s"', $fileOrPath));
        } else if (!file_exists($fileOrPath) || !is_readable($fileOrPath)) {
            throw new \RuntimeException(sprintf('File/directory ("%s") not exists and/or is not readable.', $fileOrPath));
        }
    }
}