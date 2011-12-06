<?php

namespace Knp\Invoice;

class Generator
{
    protected $generator;

    protected $theme = 'simple_theme';

    public function generate($invoice)
    {
        throw new \RuntimeException();
    }
}