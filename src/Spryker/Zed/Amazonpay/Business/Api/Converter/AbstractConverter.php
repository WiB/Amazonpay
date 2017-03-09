<?php

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\AmazonpayResponseHeaderTransfer;
use PayWithAmazon\ResponseParser;

abstract class AbstractConverter implements ConverterInterface
{
    const STATUS_CODE_SUCCESS = 200;

    /**
     * @param ResponseParser $responseParser
     *
     * @return AmazonpayResponseHeaderTransfer
     */
    protected function extractHeader(ResponseParser $responseParser)
    {
        $aResponse = $responseParser->toArray();
        $header = new AmazonpayResponseHeaderTransfer();
        $header->setIsSuccess($aResponse['ResponseStatus'] == self::STATUS_CODE_SUCCESS);
        $header->setStatusCode($aResponse['ResponseStatus']);
        $header->setRequestId($aResponse['ResponseMetadata']['RequestId']);

        return $header;
    }

    /**
     * @param ResponseParser $responseParser
     *
     * @return AddressTransfer
     */
    protected function extractAddress(ResponseParser $responseParser)
    {
        $aResponseAddress = $this->extractAddressArray($responseParser);

        $address = new AddressTransfer();

        $address->setCity($aResponseAddress['City']);
        $address->setIso2Code($aResponseAddress['CountryCode']);
        $address->setZipCode($aResponseAddress['PostalCode']);

        if (!empty($aResponseAddress['Name'])) {
            $address->setFirstName($aResponseAddress['Name']); //@todo consider parsing
            $address->setLastName($aResponseAddress['Name']);
        }

        if (!empty($aResponseAddress['AddressLine1'])) {
            $address->setAddress1($aResponseAddress['AddressLine1']);
        }

        if (!empty($aResponseAddress['AddressLine2'])) {
            $address->setAddress2($aResponseAddress['AddressLine2']);
        }

        if (!empty($aResponseAddress['AddressLine3'])) {
            $address->setAddress3($aResponseAddress['AddressLine3']);
        }

        if (!empty($aResponseAddress['District'])) {
            $address->setRegion($aResponseAddress['District']);
        }

        if (!empty($aResponseAddress['StateOrRegion'])) {
            $address->setState($aResponseAddress['StateOrRegion']);
        }

        if (!empty($aResponseAddress['Phone'])) {
            $address->setPhone($aResponseAddress['Phone']);
        }

        return $address;
    }

}
