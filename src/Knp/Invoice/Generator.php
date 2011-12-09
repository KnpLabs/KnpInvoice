<?php

namespace Knp\Invoice;

use Knp\Invoice\Model\Invoice;

class Generator
{
    protected $filename;
    protected $content = '';
    protected $generator;

    protected $theme = 'Resources/views/simple_theme';

    static protected $templates = array(
        'invoice', 'list'
    );

    public function setTheme($theme)
    {
        if (!is_string($theme)) {
            throw new \InvalidArgumentException('You need to use proper path.');
        } else if (!file_exists($theme) || !is_readable($theme)) {
            throw new \RuntimeException('Theme folder not exists and/or is not readable.');
        }

        $this->theme = $theme;
    }

    public function generate(Invoice $invoice, $template = 'invoice')
    {
        throw new \RuntimeException();
    }

    public function generateAndSave(Invoice $invoice, $filename = null, $template = 'invoice')
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
        if (!in_array($template, self::$templates)) {
            throw new \InvalidArgumentException('Unknown template name given!');
        }
    }
}