<?php
declare(strict_types=1);

namespace Lendinvest\Entity;

/**
 * Class Investor
 * @package Lendinvest\Entity
 */
class Investor
{
    /**
     * @var string
     */
    private $investorID;

    /**
     * @var string
     */
    private $fullName;

    /**
     * @var float
     */
    private $virtualWallet;

    /**
     * @var array
     */
    private $investments;

    /**
     * Investor constructor.
     * @param string $investorID
     * @param string $fullName
     * @param float $virtualWallet
     */
    public function __construct(string $investorID, string $fullName, float $virtualWallet)
    {
        $this->investorID = $investorID;
        $this->fullName = $fullName;
        $this->virtualWallet = $virtualWallet;
        $this->investments = [];

        echo "\nInvestor $fullName created";
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return float|int
     */
    public function getVirtualWallet()
    {
        return $this->virtualWallet;
    }

    /**
     * @param float $amount
     */
    public function setVirtualWallet(float $amount)
    {
        $this->virtualWallet = $amount;
    }


    /**
     * @param $amount
     */
    public function addMoneyToWallet($amount)
    {
        $this->virtualWallet += $amount;
    }

    /**
     * @param $amount
     */
    public function withdrawMoneyFromWallet($amount)
    {
        $this->virtualWallet -= $amount;
    }

    /**
     * @return Investments
     */
    public function getInvestments(): Investments
    {
        return $this->investments;
    }

    /**
     * @param Investments $investments
     */
    public function setInvestments(Investments $investments)
    {
        $this->investments = $investments;
    }
}
