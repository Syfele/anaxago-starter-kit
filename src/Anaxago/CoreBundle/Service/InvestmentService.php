<?php
namespace Anaxago\CoreBundle\Service;

use Anaxago\CoreBundle\Entity\Investment;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class InvestmentService
{
    /**
     * @var TokenStorage
     */
    private $token;

    /**
     * @var $param
     */
    private $annualRate;

    public function __construct(TokenStorage $token, $annualRate)
    {
        $this->token = $token;
        $this->annualRate = $annualRate;
    }

    /**
     * @param $amount
     * @return Investment
     */
    public function createInvestment($amount): Investment
    {
        $user = $this->token->getToken()->getUser();
        /** @var Investment $investment */
        $investment = new Investment();
        $investment->setAmount($amount);
        $investment->setUser($user);
        return $investment;
    }

    /**
     * @param Investment $investment
     * @param int $year
     * @param int $yieldSCPI
     * @return array
     */
    public function getThrift(Investment $investment,int $year, int $yieldSCPI): array
    {
        $rate = $this->annualRate;
        $amount = $investment->getAmount();
        $totalAmount = $amount + ($year * ($amount*$rate)/100);
        $monthlyAmount = $totalAmount/($year * 12);

        $monthlyAmountSCPI = $amount/($year * 12);
        $amountSCPI = $monthlyAmountSCPI + (($monthlyAmountSCPI*$yieldSCPI)/100);
        $monthlySCPI = $amountSCPI / 12;
        $saving = $monthlyAmount - $monthlySCPI;
        return ['amount' => $monthlyAmount, 'scpi' => $monthlySCPI, 'saving' => $saving];
    }
}

