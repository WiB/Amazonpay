<?php
/**
 * Created by PhpStorm.
 * User: dmitrikadykov
 * Date: 30/03/2017
 * Time: 12:19
 */

namespace Spryker\Zed\Amazonpay;


interface AmazonpayConfigInterface
{
    /**
     * @return string
     */
    public function getClientId();

    /**
     * @return string
     */
    public function getAccessKeyId();

    /**
     * @return string
     */
    public function getSellerId();

    /**
     * @return string
     */
    public function getSecretAccessKey();

    /**
     * @return string
     */
    public function getClientSecret();

    /**
     * @return string
     */
    public function getRegion();

    /**
     * @return string
     */
    public function getCurrencyIsoCode();

    /**
     * @return string
     */
    public function isSandbox();

    /**
     * @return string
     */
    public function getErrorReportLevel();

}
