<?php
namespace Spryker\Shared\Amazonpay;

use Spryker\Shared\Kernel\Store;
use Spryker\Shared\Kernel\AbstractBundleConfig;

class AmazonpayConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->get(AmazonpayConstants::CLIENT_ID);
    }

    /**
     * @return string
     */
    public function getAccessKeyId()
    {
        return $this->get(AmazonpayConstants::ACCESS_KEY_ID);
    }

    /**
     * @return string
     */
    public function getSellerId()
    {
        return $this->get(AmazonpayConstants::SELLER_ID);
    }

    /**
     * @return string
     */
    public function getSecretAccessKey()
    {
        return $this->get(AmazonpayConstants::SECRET_ACCESS_KEY);
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->get(AmazonpayConstants::CLIENT_SECRET);
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->get(AmazonpayConstants::REGION);
    }

    /**
     * @return string
     */
    public function getStoreName()
    {
        return $this->get(AmazonpayConstants::STORE_NAME);
    }

    /**
     * @return string
     */
    public function getCurrencyIsoCode()
    {
        return Store::getInstance()->getCurrencyIsoCode();
    }

    /**
     * @return string
     */
    public function isSandbox()
    {
        return (bool) $this->get(AmazonpayConstants::SANDBOX);
    }

}