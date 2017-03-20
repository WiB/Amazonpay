<?php
namespace Spryker\Client\Amazonpay\Zed;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Client\ZedRequest\ZedRequestClient;

class AmazonpayStub implements AmazonpayStubInterface
{
    /**
     * @var \Spryker\Client\ZedRequest\Client\ZedClient
     */
    protected $zedStub;

    /**
     * @param \Spryker\Client\ZedRequest\ZedRequestClient $zedStub
     */
    public function __construct(ZedRequestClient $zedStub)
    {
        $this->zedStub = $zedStub;
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function handleCartWithAmazonpay(QuoteTransfer $quoteTransfer)
    {
        return $this->zedStub->call('/amazonpay/gateway/handle-cart-with-amazonpay', $quoteTransfer);
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function addSelectedAddressToQuote(QuoteTransfer $quoteTransfer)
    {
        return $this->zedStub->call('/amazonpay/gateway/add-selected-address-to-quote', $quoteTransfer);
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function addSelectedShipmentMethodToQuote(QuoteTransfer $quoteTransfer)
    {
        return $this->zedStub->call(
            '/amazonpay/gateway/add-selected-shipment-method-to-quote',
            $quoteTransfer
        );
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function confirmPurchase(QuoteTransfer $quoteTransfer)
    {
        return $this->zedStub->call('/amazonpay/gateway/confirm-purchase', $quoteTransfer);
    }

}
