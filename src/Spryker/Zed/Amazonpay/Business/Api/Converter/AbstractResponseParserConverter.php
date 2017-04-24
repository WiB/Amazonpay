<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\AmazonpayResponseConstraintTransfer;
use Generated\Shared\Transfer\AmazonpayResponseHeaderTransfer;
use PayWithAmazon\ResponseParser;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

abstract class AbstractResponseParserConverter extends AbstractConverter implements ResponseParserConverterInterface
{

    const STATUS_CODE_SUCCESS = 200;

    /**
     * @var string
     */
    protected $resultKeyName;

    /**
     * @return string
     */
    abstract protected function getResponseType();

    abstract protected function createTransferObject();

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $responseTransfer
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return \Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    protected function setBody(AbstractTransfer $responseTransfer, ResponseParser $responseParser)
    {
        return $responseTransfer;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $responseTransfer
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return \Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    protected function setResponseDataToTransfer(AbstractTransfer $responseTransfer, ResponseParser $responseParser)
    {
        $responseTransfer->setHeader($this->extractHeader($responseParser));
        if ($responseTransfer->getHeader()->getIsSuccess()) {
            return $this->setBody($responseTransfer, $responseParser);
        }

        return $responseTransfer;
    }

    /**
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return \Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    public function convert(ResponseParser $responseParser)
    {
        return $this->setResponseDataToTransfer($this->createTransferObject(), $responseParser);
    }

    /**
     * @param \PayWithAmazon\ResponseParser $responseParser
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
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return int
     */
    protected function extractStatusCode(ResponseParser $responseParser)
    {
        return (int)$responseParser->toArray()['ResponseStatus'];
    }

    /**
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return \Generated\Shared\Transfer\AmazonpayResponseHeaderTransfer
     */
    protected function extractHeader(ResponseParser $responseParser)
    {
        $statusCode = $this->extractStatusCode($responseParser);
        $metadata = $this->extractMetadata($responseParser);
        $constraints = $this->extractConstraints($responseParser);

        $header = new AmazonpayResponseHeaderTransfer();
        $header->setIsSuccess($this->isSuccess($responseParser));
        $header->setStatusCode($statusCode);

        if ($metadata) {
            $header->setRequestId($metadata['RequestId']);
        }

        if (!empty($responseParser->toArray()['Error'])) {
            $header->setErrorMessage($responseParser->toArray()['Error']['Message']);
            $header->setErrorCode($responseParser->toArray()['Error']['Code']);
            $header->setRequestId($responseParser->toArray()['RequestId']);

            return $header;
        }

        if ($constraints) {
            $header->setConstraints($constraints);
        }

        return $header;
    }

    /**
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return bool
     */
    protected function isSuccess(ResponseParser $responseParser)
    {
        return
            $this->extractStatusCode($responseParser) == self::STATUS_CODE_SUCCESS
            && empty($this->extractConstraints($responseParser));
    }

    /**
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return array
     */
    protected function extractResult(ResponseParser $responseParser)
    {
        $responseType = $this->getResponseType();

        return !empty($responseParser->toArray()[$responseType])
            ? $responseParser->toArray()[$responseType]
            : [];
    }

    /**
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return \Generated\Shared\Transfer\AmazonpayResponseConstraintTransfer[]
     */
    protected function extractConstraints(ResponseParser $responseParser)
    {
        $result = $this->extractResult($responseParser);

        if (empty($result['OrderReferenceDetails']['Constraints'])) {
            return [];
        }

        $constraintTransfers = [];

        if (count($result['OrderReferenceDetails']['Constraints']) === 1) {
            $constraints = array_values($result['OrderReferenceDetails']['Constraints']);
        } else {
            $constraints = $result['OrderReferenceDetails']['Constraints'];
        }

        foreach ($constraints as $constraint) {
            $constraintTransfer = new AmazonpayResponseConstraintTransfer();
            $constraintTransfer->setConstraintId($constraint['ConstraintID']);
            $constraintTransfer->setConstraintId($constraint['Description']);

            $constraintTransfers[] = $constraintTransfer;
        }

        return $constraintTransfers;
    }

    /**
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return \Generated\Shared\Transfer\AddressTransfer
     */
    protected function extractShippingAddress(ResponseParser $responseParser)
    {
        $address = new AddressTransfer();

        if (!$this->isSuccess($responseParser)) {
            return $address;
        }

        $aResponseAddress =
            $this->extractResult($responseParser)['OrderReferenceDetails']['Destination']['PhysicalDestination'];

        return $this->convertAddressToTransfer($aResponseAddress);
    }

    /**
     * @param array $addressData
     *
     * @return \Generated\Shared\Transfer\AddressTransfer
     */
    protected function convertAddressToTransfer(array $addressData)
    {
        $address = new AddressTransfer();

        $address->setCity($addressData['City']);
        $address->setIso2Code($addressData['CountryCode']);
        $address->setZipCode($addressData['PostalCode']);

        if (!empty($addressData['Name'])) {
            $address = $this->updateNameData($address, $addressData['Name']);
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


}
