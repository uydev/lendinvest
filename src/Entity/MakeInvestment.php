<?php
namespace Lendinvest\Entity;

use DateTime;
use Exception;

/**
 * Class MakeInvestment
 * @package Lendinvest\Entity
 */
final class MakeInvestment implements MakeInvestmentInterface
{
    /**
     * @var Investor
     */
    private $investor;

    /**
     * @var Tranche
     */
    private $tranche;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var DateTime
     */
    private $date;

    /**
     * MakeInvestment constructor.
     * @param Investor $investor
     * @param Tranche $tranche
     * @param float $amount
     * @param DateTime $date
     */
    public function __construct(Investor $investor, Tranche $tranche, float $amount, DateTime $date)
    {
        $this->investor = $investor;
        $this->tranche = $tranche;
        $this->amount = $amount;
        $this->date = $date;
    }

    /**
     * Makes the actual investment
     * after doing certain checks
     */
    public function makeInvestment()
    {
//        try {
        if ($this->tranche->getTrancheStatus() == 'open' && ($this->investor->getVirtualWallet() >= $this->amount)
            && ($this->amount <= $this->tranche->getMaximumAvailable())) {

            if ($this->date->format('m-d-Y') <= $this->tranche->getLoan()->getEndDate()->format('m-d-Y')
                && ($this->date->format('m-d-Y') >= $this->tranche->getLoan()->getStartDate()->format('m-d-Y'))) {

                if ($this->amount <= $this->investor->getVirtualWallet()) {

                    $investment = new Investments($this->amount, $this->investor, $this->tranche, $this->date);
                    $this->investor->setInvestments($investment);
                    $this->tranche->setInvestments($investment);

                    // We deduct from the maximum available in the tranch since an investor has invested
                    $this->tranche->setMaximumAvailable($this->tranche->getMaximumAvailable() - $this->amount);

                } else {
                    throw new Exception("\nThere is not enough balance for the investment amount specified", 100);
                }

            } else {
                throw new Exception("\nThis tranche is no longer accepting investments");
            }

        } else {
            throw new Exception("\nThis exceeds the amount available on this tranche", 101);
        }
//        }
//        catch (Exception $e) {
//            echo $e->getMessage();
//        }
    }

    /**
     * @return Investor
     */
    public function getInvestor(): Investor
    {
        return $this->investor;
    }

    /**
     * @return Tranche
     */
    public function getTranche(): Tranche
    {
        return $this->tranche;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
}
