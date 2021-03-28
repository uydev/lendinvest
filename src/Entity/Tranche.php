<?php
declare(strict_types=1);
namespace Lendinvest\Entity;
/**
 * Class Tranche
 * @package Lendinvest\Entity
 */
class Tranche extends Loan
{
    /**
     * @var string
     */
    private $trancheId;

    /**
     * @var Loan
     */
    private $loan;

    /**
     * @var float
     */
    private $monthlyInterestRate;

    /**
     * @var float
     */
    private $maximumAvailable;

    /**
     * @var string
     */
    private $trancheStatus;

    /**
     * @var array
     */
    private $investments;

    /**
     * @var array
     */
    private $tranches;

    /**
     * Tranche constructor.
     * @param string $trancheId
     * @param Loan $loan
     * @param float $monthlyInterestRate
     * @param float $maximumAvailable
     * @param string $trancheStatus
     */
    public function __construct(string $trancheId, Loan $loan, float $monthlyInterestRate, float $maximumAvailable, string $trancheStatus = 'open')
    {
        $this->trancheId = $trancheId;
        $this->loan = $loan;
        $this->monthlyInterestRate = $monthlyInterestRate;
        $this->maximumAvailable = $maximumAvailable;
        $this->trancheStatus = $trancheStatus;
        $this->tranches = [];

        echo "\nTranche $trancheId Created";
    }

    /**
     * @return string
     */
    public function getTrancheId(): string
    {
        return $this->trancheId;
    }

    /**
     * @param float $monthlyInterestRate
     */
    public function setMonthlyInterestRate(float $monthlyInterestRate)
    {
        $this->monthlyInterestRate = $monthlyInterestRate;
    }

    /**
     * @return float
     */
    public function getMonthlyInterestRate(): float
    {
        return $this->monthlyInterestRate;
    }

    /**
     * @param float $amount
     */
    public function setMaximumAvailable(float $amount)
    {
        $this->maximumAvailable = $amount;
    }

    /**
     * @return float
     */
    public function getMaximumAvailable(): float
    {
        return $this->maximumAvailable;
    }

    /**
     * @return Loan
     */
    public function getLoan(): Loan
    {
        return $this->loan;
    }

    /**
     * @return array
     */
    public function getListOfInvestments(): array
    {
        return $this->investments;
    }

    public function setInvestments(Investments $investments)
    {
        $this->investments = $investments;
    }

    /**
     *  Get tranches status
     */
    public function getTrancheStatus(): string
    {
        return $this->trancheStatus;
    }

    /**
     * Closes Tranche
     */
    public function closeTranche()
    {
        $this->trancheStatus = 'closed';
    }


    /**
     * Opens the Tranche
     */
    public function openTranch()
    {
        $this->trancheStatus = 'open';
    }
}
