<?php
namespace Lendinvest\Entity;

use DateTime;

/**
 * Class Investments
 * @package Lendinvest\Entity
 */
class Investments
{
    /**
     * @var float
     */
    private $amount;

    /**
     * @var Investor
     */
    private $investor;

    /**
     * @var Tranche
     */
    private $tranche;

    /**
     * @var
     */
    private $date;

    /**
     * @var array
     */
    static $instances = array();

    /**
     * Investments constructor.
     * @param float $amount
     * @param Investor $investor
     * @param Tranche $tranche
     * @param DateTime $date
     */
    public function __construct(float $amount, Investor $investor, Tranche $tranche, DateTime $date)
    {
        $this->amount = $amount;
        $this->investor = $investor;
        $this->tranche = $tranche;
        $this->date = $date;
        Investments::$instances[] = $this;
    }

    /**
     * @return Investor
     */
    public function getInvestor(): Investor
    {
        return $this->investor;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
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
    public function getDailyInterestRate(): float
    {
        $date = $this->getDate();
        $month = $date->format('n');
        $year = $date->format('Y');

        $numberOfDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        return $this->tranche->getMonthlyInterestRate() / $numberOfDaysInMonth;
    }

    /**
     * Calculate the return on investment
     * @return float
     */
    public function calculateROI(): float
    {
        $trancheEndDate = $this->tranche->getLoan()->getEndDate();

        //Get the date the investment was made
        $investorInvestDate = $this->getDate();

        //Get the last day of the month in which investment was made
        $lastDayOftheMonth = $this->getDate()->format('m-t-Y');

        //Converted into object into the format we want
        $lastDayOftheMonth = DateTime::createfromformat('m-d-Y', $lastDayOftheMonth);

        //Calculate based on end of the month or end date of the tranche being active
        //whichever is sooner
        if ($lastDayOftheMonth <= $trancheEndDate) {
            $calculationDate = $lastDayOftheMonth;
        } else {
            $calculationDate = $trancheEndDate;
        }
        $interval = $investorInvestDate->diff($calculationDate);
        $numberOfDaysInvested = $interval->format('%a');

        //We add 1 since the start date is inclusive
        $investedPeriodInterestRate = ($numberOfDaysInvested + 1) * $this->getDailyInterestRate();
        $earnedInterest = round($this->amount / 100 * $investedPeriodInterestRate, 2);
        $this->investor->addMoneyToWallet($earnedInterest);

        return round($earnedInterest, 2);
    }
}
