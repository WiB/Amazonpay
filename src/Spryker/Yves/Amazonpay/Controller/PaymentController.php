<?php
namespace Spryker\Yves\Amazonpay\Controller;

use Generated\Shared\Transfer\AmazonpayPaymentTransfer;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Spryker\Yves\Amazonpay\AmazonpayFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method AmazonpayFactory getFactory()
 * @method \Spryker\Client\Amazonpay\AmazonpayClient getClient()
 */
class PaymentController extends AbstractController
{
    /**
     * @param Request $request
     */
    public function checkoutAction(Request $request)
    {
//        $amazonPaymentTransfer = new AmazonpayPaymentTransfer();
//        $amazonPaymentTransfer->setOrderReferenceId($request->query->get('referenceId'));
//        $amazonPaymentTransfer->setAddressConsentToken($request->query->get('access_token'));
//
//        $quote = $this->getFactory()->getQuoteClient()->getQuote();
//        $quote->setAmazonPayment($amazonPaymentTransfer);
//        $quote = $this->getClient()->handleCartWithAmazonpay($quote);
//        $this->getFactory()->getQuoteClient()->setQuote($quote);
        return [
            'quoteTransfer' => $this->getFactory()->getQuoteClient()->getQuote()
        ];
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function getShipmentOptionsAction(Request $request)
    {
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function placeOrderAction(Request $request)
    {
    }
}
