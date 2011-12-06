<?php

namespace Knp\Invoice\Model;

class Tax
{
    protected $id;

    protected $name;

    protected $value = 0;

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

    public function setTax($value)
    {
        $value = (int) $value;
        if ($value < 0) {
            throw new \InvalidArgumentException();
        }

        $this->value = $value;
    }
}
