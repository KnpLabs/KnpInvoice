<?php

namespace Knp\Invoice\Model;

class Seller extends Client
{
    protected $logotype;
    protected $account_number;

    public function getAccountNumber()
    {
        return $this->account_number;
    }

    public function getLogo()
    {
        return $this->logotype;
    }

    public function setAccountNumber($accountNumber)
    {
        $this->account_number = $accountNumber;
    }

    public function setLogo($logotype)
    {
        if (!file_exists($logotype)) {
            throw new \InvalidArgumentException(sprintf('Logo file ("%s") not exists!', $logotype));
        }

        $this->logotype = $logotype;
    }
}