<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\GetOrderReferenceDetailsAmazonpayResponseTransfer;
use PayWithAmazon\ResponseParser;

class GetOrderReferenceDetailsConverter extends AbstractConverter
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

    /**
     * @param ResponseParser $responseParser
     *
     * @return AddressTransfer
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
    public function toTransactionResponseTransfer(ResponseParser $responseParser)
    {
        $responseTransfer = new GetOrderReferenceDetailsAmazonpayResponseTransfer();
        $responseTransfer->setHeader($this->extractHeader($responseParser));
        $responseTransfer->setShippingAddress($this->extractShippingAddress($responseParser));
        $responseTransfer->setBillingAddress($this->extractBillingAddress($responseParser));

        return $responseTransfer;
    }
}
