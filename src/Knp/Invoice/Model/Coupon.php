<?php

namespace Knp\Invoice\Model;

class Coupon
{
    protected $id;

    protected $name;

    protected $value = 0;

    protected $expiresAt;

    public function getName()
    {
        return $this->name;
    }

    public function getValue()
    {
        if ($this->expiresAt && new \DateTime('NOW') <= $this->expiresAt) {
            return 0;
        }

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

    public function setExpiresAt($date)
    {
        $this->expiresAt = new \DateTime($date);
    }
}
