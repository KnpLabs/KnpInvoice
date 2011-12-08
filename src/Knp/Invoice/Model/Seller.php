<?php

namespace Knp\Invoice\Model;

class Seller extends Client
{
    protected $logotype;

    public function getLogo()
    {
        return $this->logotype;
    }

    public function setLogo($logotype)
    {
        if (!file_exists($logotype)) {
            throw new \InvalidArgumentException(sprintf('Logo file ("%s") not exists!', $logotype));
        }

        $this->logotype = $logotype;
    }
}