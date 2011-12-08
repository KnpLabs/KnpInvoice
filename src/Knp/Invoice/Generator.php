<?php

namespace Knp\Invoice;

use Knp\Invoice\Model\Invoice;

class Generator
{
    protected $filename;
    protected $content = '';
    protected $generator;

    protected $theme = 'Resources/views/simple_theme';

    public function setTheme($theme)
    {
        if (!is_string($theme)) {
            throw new \InvalidArgumentException('You need to use proper path.');
        } else if (!file_exists($theme) || !is_readable($theme)) {
            throw new \RuntimeException('Theme folder not exists and/or is not readable.');
        }

        $this->theme = $theme;
    }

    public function generate(Invoice $invoice)
    {
        throw new \RuntimeException();
    }

    public function generateAndSave(Invoice $invoice, $filename = null)
    {
        throw new \RuntimeException();
    }

    public function __toString()
    {
        if (!$this->content) {
            throw new \RuntimeException('You need to call `generate()` function first!');
        }

        return $this->content;
    }
}