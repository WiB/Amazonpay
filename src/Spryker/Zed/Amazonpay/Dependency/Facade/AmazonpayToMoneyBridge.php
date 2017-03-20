<?php
namespace Spryker\Zed\Amazonpay\Dependency\Facade;

use Spryker\Zed\Money\Business\MoneyFacadeInterface;

class AmazonpayToMoneyBridge implements AmazonpayToMoneyInterface
{

    /**
     * @var \Spryker\Zed\Money\Business\MoneyFacadeInterface
     */
    protected $moneyFacade;

    /**
     * @param \Spryker\Zed\Money\Business\MoneyFacadeInterface $moneyFacade
     */
    public function __construct(MoneyFacadeInterface $moneyFacade)
    {
        $this->moneyFacade = $moneyFacade;
    }

    /**
     * @param int $value
     *
     * @return float
     */
    public function convertIntegerToDecimal($value)
    {
        return $this->moneyFacade->convertIntegerToDecimal($value);
    }

}
