<?php
/**
 * Created by PhpStorm.
 * User: dmitrikadykov
 * Date: 29/03/2017
 * Time: 17:24
 */

namespace Spryker\Zed\Amazonpay\Business\Quote;


interface QuoteUpdateFactoryInterface
{
    /**
     * @return \Spryker\Zed\Amazonpay\Business\Quote\QuoteUpdaterInterface
     */
    public function createShippingAddressQuoteDataUpdater();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Quote\QuoteUpdaterInterface
     */
    public function createQuoteDataInitializer();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Quote\QuoteUpdaterInterface
     */
    public function createShipmentDataQuoteInitializer();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Quote\QuoteUpdaterInterface
     */
    public function createShipmentDataQuoteUpdater();
}