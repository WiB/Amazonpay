<?php
/**
 * Created by PhpStorm.
 * User: dmitrikadykov
 * Date: 29/03/2017
 * Time: 17:42
 */

namespace Spryker\Yves\Amazonpay;


interface AmazonpayFactoryInterface
{
    /**
     * @return \Spryker\Client\Quote\QuoteClient
     */
    public function getQuoteClient();

    /**
     * @return \Spryker\Client\Checkout\CheckoutClient
     */
    public function getCheckoutClient();

    /**
     * @return \Spryker\Shared\Amazonpay\AmazonpayConfig
     */
    public function getConfig();

    /**
     * @return \Spryker\Client\Shipment\ShipmentClient
     */
    public function getShipmentClient();

    /**
     * @return \Spryker\Client\Calculation\CalculationClient
     */
    public function getCalculationClient();

}
