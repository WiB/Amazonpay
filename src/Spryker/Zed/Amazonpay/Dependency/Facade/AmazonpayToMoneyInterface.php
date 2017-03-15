<?php
namespace Spryker\Zed\Amazonpay\Dependency\Facade;

interface AmazonpayToMoneyInterface
{

    /**
     * @param int $value
     *
     * @return float
     */
    public function convertIntegerToDecimal($value);

}
