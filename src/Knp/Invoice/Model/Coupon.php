<?php

namespace Knp\Invoice\Model;

class Coupon
{
    protected $name;

    protected $value = 0;

    protected $expiresAt;

    public function getName()
    {
        return $this->name;
    }

    public function getValue()
    {
        if ($this->expiresAt) {
            $date = new \DateTime('NOW');
            $interval = $date->diff($this->expiresAt);
            if ($interval->format('%d')) {
                return 0;
            }
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
            throw new \OutOfBoundsException();
        }

        $this->value = $value;
    }

    public function setExpiresAt($date)
    {
        $this->expiresAt = new \DateTime($date);
    }
}
