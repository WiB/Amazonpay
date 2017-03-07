<?php
namespace Spryker\Zed\Amazonpay\Communication\Controller;

use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentMethodTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \Spryker\Zed\Checkout\Business\CheckoutFacade getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function handleWithAmazonpayAction(QuoteTransfer $quoteTransfer)
    {
        $paymentTransfer = new PaymentTransfer();
        $paymentTransfer->setPaymentMethod('Amazonpay'); // @todo decalre as constant somwhere

        $shipmentMethod = new ShipmentMethodTransfer();
        $shipmentMethod->setCarrierName('Amazonpay'); // @todo decalre as constant somwhere
        $shipmentMethod->setName('Amazonpay');
        $shipmentMethod->setDefaultPrice(0);

        $shipment = new ShipmentTransfer();
        $shipment->setMethod($shipmentMethod);

        $quoteTransfer->setPayment($paymentTransfer);
        $quoteTransfer->setShipment($shipment);

        return $quoteTransfer;
    }

}
