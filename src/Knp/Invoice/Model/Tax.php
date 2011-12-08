<?php

namespace Knp\Invoice\Model;

class Tax
{
    protected $name;

    protected $value = 0;

    public function __construct($name = null, $value = 0)
    {
        $this->name = $name;
        $this->setValue($value);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setValue($value)
    {
        $value = (int) $value;
        if ($value < 0) {
            throw new \InvalidArgumentException();
        }

        $this->value = $value;
    }
}
