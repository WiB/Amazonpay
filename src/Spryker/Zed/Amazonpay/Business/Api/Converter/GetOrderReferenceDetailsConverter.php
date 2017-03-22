<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\GetOrderReferenceDetailsAmazonpayResponseTransfer;
use PayWithAmazon\ResponseParser;

class GetOrderReferenceDetailsConverter extends AbstractResponseParserConverter
{
    /**
     * @param ResponseParser $responseParser
     *
     * @return array
     */
    protected function extractResult(ResponseParser $responseParser)
    {
        return $responseParser->toArray()['GetOrderReferenceDetailsResult'];
    }

    protected function extractOrderReferenceStatus(ResponseParser $responseParser)
    {
        return $this->extractResult($responseParser)['OrderReferenceDetails']['OrderReferenceStatus']['State'];
    }

    /**
     * @param ResponseParser $responseParser
     *
     * @return AddressTransfer
     */
    protected function extractBillingAddress(ResponseParser $responseParser)
    {
        $address = new AddressTransfer();

        if (!$this->isSuccess($responseParser)) {
            return $address;
        }

        $aResponseAddress =
            $this->extractResult($responseParser)['OrderReferenceDetails']['BillingAddress']['PhysicalAddress'];

        return $this->convertAddressToTransfer($aResponseAddress);
    }

    /**
     * @param ResponseParser $responseParser
     *
     * @return GetOrderReferenceDetailsAmazonpayResponseTransfer
     */
    public function convert(ResponseParser $responseParser)
    {
        $responseTransfer = new GetOrderReferenceDetailsAmazonpayResponseTransfer();
        $responseTransfer->setHeader($this->extractHeader($responseParser));
        $responseTransfer->setOrderReferenceStatus($this->extractOrderReferenceStatus($responseParser));
        $responseTransfer->setShippingAddress($this->extractShippingAddress($responseParser));
        $responseTransfer->setBillingAddress($this->extractBillingAddress($responseParser));

        return $responseTransfer;
    }
}
