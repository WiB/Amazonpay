<?php
namespace Spryker\Zed\Amazonpay\Business\Model;

use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentMethodTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use Spryker\Shared\Amazonpay\AmazonpayConstants;

class QuoteDataUpdater
{
    /**
     * @param QuoteTransfer $quoteTransfer
     * 
     * @return QuoteTransfer
     */
    public function update(QuoteTransfer $quoteTransfer)
    {
        $paymentTransfer = new PaymentTransfer();
        $paymentTransfer->setPaymentMethod(AmazonpayConstants::PAYMENT_METHOD);
        $paymentTransfer->setPaymentProvider(AmazonpayConstants::PAYMENT_METHOD);
        $paymentTransfer->setPaymentSelection(AmazonpayConstants::PAYMENT_METHOD);

        $shipmentMethod = new ShipmentMethodTransfer();
        $shipmentMethod->setCarrierName(AmazonpayConstants::PAYMENT_METHOD);
        $shipmentMethod->setName(AmazonpayConstants::PAYMENT_METHOD);
        $shipmentMethod->setDefaultPrice(0);
        $shipmentMethod->setIdShipmentMethod(3); //@todo retrieve shipment method from DB instead
        $shipmentMethod->setFkShipmentCarrier(2);//@todo same

        $shipment = new ShipmentTransfer();
        $shipment->setMethod($shipmentMethod);

        $quoteTransfer->setPayment($paymentTransfer);
        $quoteTransfer->setShipment($shipment);

        return $quoteTransfer;
    }
}