<?php

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\AmazonpayResponseConstraintTransfer;
use Generated\Shared\Transfer\AmazonpayResponseHeaderTransfer;
use Generated\Shared\Transfer\AmazonPriceTransfer;
use PayWithAmazon\ResponseParser;

abstract class AbstractConverter implements ConverterInterface
{
    const STATUS_CODE_SUCCESS = 200;

    /**
     * @var string
     */
    protected $resultKeyName;

    /**
     * @param ResponseParser $responseParser
     *
     * @return array
     */
    protected abstract function extractResult(ResponseParser $responseParser);

    /**
     * @param ResponseParser $responseParser
     *
     * @return array
     */
    protected function extractMetadata(ResponseParser $responseParser)
    {
        return empty($responseParser->toArray()['ResponseMetadata'])
            ? []
            : $responseParser->toArray()['ResponseMetadata'];
    }

    /**
     * @param ResponseParser $responseParser
     *
     * @return int
     */
    protected function extractStatusCode(ResponseParser $responseParser)
    {
        return (int) $responseParser->toArray()['ResponseStatus'];
    }

    /**
     * @param ResponseParser $responseParser
     *
     * @return AmazonpayResponseHeaderTransfer
     */
    protected function extractHeader(ResponseParser $responseParser)
    {
        $statusCode = $this->extractStatusCode($responseParser);
        $metadata = $this->extractMetadata($responseParser);
        $constraints = $this->extractConstraints($responseParser);

        $header = new AmazonpayResponseHeaderTransfer();
        $header->setIsSuccess($this->isSuccess($responseParser));

        if ($constraints) {
            $header->setConstraints($constraints);
        }

        $header->setStatusCode($statusCode);

        if ($metadata) {
            $header->setRequestId($metadata['RequestId']);
        }

        return $header;
    }

    /**
     * @param ResponseParser $responseParser
     * @return bool
     */
    protected function isSuccess(ResponseParser $responseParser)
    {
        return 
            $this->extractStatusCode($responseParser) == self::STATUS_CODE_SUCCESS
            && empty($this->extractConstraints($responseParser));
    }

    /**
     * @param ResponseParser $responseParser
     *
     * @return AmazonpayResponseConstraintTransfer[]
     */
    protected function extractConstraints(ResponseParser $responseParser)
    {
        $result = $this->extractResult($responseParser);

        if (empty($result['OrderReferenceDetails']['Constraints'])) {
            return [];
        }

        $constraintTransfers = [];
        foreach ($result['OrderReferenceDetails']['Constraints']['Constraint'] as $constraint) {
            $constraintTransfer = new AmazonpayResponseConstraintTransfer();
            $constraintTransfer->setConstraintId($constraint['ConstraintID']);
            $constraintTransfer->setConstraintId($constraint['Description']);

            $constraintTransfers[] = $constraintTransfer;
        }

        return $constraintTransfers;
    }

    /**
     * @param array $addressData
     *
     * @return AddressTransfer
     */
    protected function convertAddressToTransfer(array $addressData)
    {
        $address = new AddressTransfer();

        $address->setCity($addressData['City']);
        $address->setIso2Code($addressData['CountryCode']);
        $address->setZipCode($addressData['PostalCode']);

        if (!empty($addressData['Name'])) {
            $names = explode(' ', $addressData['Name'], 2);

            if (sizeof($names) >= 2) {
                $address->setFirstName($names[0]);
                $address->setLastName($names[1]);
            } else {
                $address->setFirstName($addressData['Name']);
                $address->setLastName($addressData['Name']);
            }
        }

        if (!empty($addressData['AddressLine1'])) {
            $address->setAddress1($addressData['AddressLine1']);
        }

        if (!empty($addressData['AddressLine2'])) {
            $address->setAddress2($addressData['AddressLine2']);
        }

        if (!empty($addressData['AddressLine3'])) {
            $address->setAddress3($addressData['AddressLine3']);
        }

        if (!empty($addressData['District'])) {
            $address->setRegion($addressData['District']);
        }

        if (!empty($addressData['StateOrRegion'])) {
            $address->setState($addressData['StateOrRegion']);
        }

        if (!empty($addressData['Phone'])) {
            $address->setPhone($addressData['Phone']);
        }

        return $address;
    }

    /**
     * @param array $priceData
     *
     * @return AmazonPriceTransfer
     */
    protected function convertPriceToTransfer(array $priceData)
    {
        $priceTransfer = new AmazonPriceTransfer();

        $priceTransfer->setAmount($priceData['Amount']);
        $priceTransfer->setCurrencyCode($priceData['CurrencyCode']);

        return $priceTransfer;
    }

}
