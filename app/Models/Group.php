<?php

namespace App\Models;


class Group
{
    public $uniqueId;
    public $totalPrice;
    public $outbound = [];
    public $inbound = [];

    public function __construct()
    {
        $this->uniqueId = uniqid();
    }

    public function getTotalPrice()
    {
        if (empty($this->outbound) || empty($this->inbound)) {
            throw new \Exception('Inbound and outbound fields cannot be empty!');
        }

        $this->totalPrice = $this->inbound->first()->price + $this->outbound->first()->price;
    }
}
