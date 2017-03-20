<?php
namespace Spryker\Yves\Amazonpay\Controller;

use Generated\Shared\Transfer\AmazonpayPaymentTransfer;
use Spryker\Yves\Amazonpay\Plugin\Provider\AmazonpayControllerProvider;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Spryker\Yves\Amazonpay\AmazonpayFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     *
     * @return []
     */
    public function checkoutAction(Request $request)
    {
        $amazonPaymentTransfer = new AmazonpayPaymentTransfer();
        $amazonPaymentTransfer->setOrderReferenceId($request->query->get('reference_id'));
        $amazonPaymentTransfer->setAddressConsentToken($request->query->get('access_token'));

        $quote = $this->getFactory()->getQuoteClient()->getQuote();
        $quote->setAmazonPayment($amazonPaymentTransfer);
        $quote = $this->getClient()->handleCartWithAmazonpay($quote);
        $this->getFactory()->getQuoteClient()->setQuote($quote);

        return [
            'quoteTransfer' => $quote
        ];
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function setOrderReferenceAction(Request $request)
    {
        $quote = $this->getFactory()->getQuoteClient()->getQuote();
        $quote->getAmazonPayment()->setOrderReferenceId($request->request->get('reference_id'));

        return new JsonResponse(['success' => true]);
    }

    /**
     * @param Request $request
     *
     * @return []
     */
    public function getShipmentMethodsAction(Request $request)
    {
        $quote = $this->getFactory()->getQuoteClient()->getQuote();
        $quote = $this->getClient()->addSelectedAddressToQuote($quote);
        $shipmentMethods = $this->getFactory()->getShipmentClient()->getAvailableMethods($quote);

        return [
            'shipmentMethods' => $shipmentMethods->getMethods(),
        ];
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function setShipmentMethodAction(Request $request)
    {
        $quote = $this->getFactory()->getQuoteClient()->getQuote();
        $quote->getShipment()->setShipmentSelection((int) $request->request->get('shipment_method_id'));
        $quote = $this->getClient()->addSelectedShipmentMethodToQuote($quote);
        $this->getFactory()->getQuoteClient()->setQuote($quote);

        return new JsonResponse(['success' => true]);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function confirmPurchaseAction(Request $request)
    {
        $quote = $this->getFactory()->getQuoteClient()->getQuote();

        if (!$quote) {
            //@todo implement proper eror handling
            return new Response('Error');
        }

        $quote = $this->getClient()->confirmPurchase($quote);
        $this->getFactory()->getQuoteClient()->setQuote($quote);

        $checkoutResponseTransfer = $this->getFactory()->getCheckoutClient()->placeOrder($quote);

        if ($checkoutResponseTransfer->getIsSuccess()) {
            return $this->redirectResponseInternal(AmazonpayControllerProvider::SUCCESS);
        }

        //@todo implement proper eror handling
        return new Response('Error');
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function successAction(Request $request)
    {
        $this->getFactory()->getQuoteClient()->clearQuote();

        return [];
    }

}
