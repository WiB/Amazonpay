<?php
namespace Spryker\Yves\Amazonpay\Controller;

use Generated\Shared\Transfer\AmazonpayPaymentTransfer;
use Pyz\Yves\Cart\Plugin\Provider\CartControllerProvider;
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
            $this->addErrorMessage($this->getApplication()->trans('amazonpay.payment.failed'));

            return $this->redirectResponseInternal(CartControllerProvider::ROUTE_CART);
        }

        $quote = $this->getClient()->confirmPurchase($quote);

        if ($quote->getAmazonPayment()->getResponseHeader()->getIsSuccess()) {
            if (!$quote->getAmazonPayment()->getAuthorizationDetails()->getIsDeclined()) {
                $checkoutResponseTransfer = $this->getFactory()->getCheckoutClient()->placeOrder($quote);

                if ($checkoutResponseTransfer->getIsSuccess()) {
                    return $this->redirectResponseInternal(AmazonpayControllerProvider::SUCCESS);
                }

                //@todo implement proper error handling (if neccessary)
                return new Response('Persisting Order Error');
            }

            if ($quote->getAmazonPayment()->getAuthorizationDetails()->getIsPaymentMethodInvalid()) {
                $this->getFactory()->getQuoteClient()->setQuote($quote);
                return $this->redirectResponseInternal(AmazonpayControllerProvider::CHANGE_PAYMENT_METHOD);
            } else {
                return $this->redirectResponseInternal(AmazonpayControllerProvider::PAYMENT_FAILED);
            }
        }

        // @todo maybe generate a more detailed message based on constraints (if any)
        $this->addErrorMessage($this->getApplication()->trans('amazonpay.payment.failed'));

        return $this->redirectResponseInternal(CartControllerProvider::ROUTE_CART);
    }

    /**
     * @param Request $request
     *
     * @return []
     */
    public function changePaymentMethodAction(Request $request)
    {
        $quote = $this->getFactory()->getQuoteClient()->getQuote();

        return [
            'quoteTransfer' => $quote
        ];
    }

    /**
     * @param Request $request
     *
     * @return []
     */
    public function paymentFailedAction(Request $request)
    {
        $quote = $this->getFactory()->getQuoteClient()->getQuote();
        $this->addErrorMessage($this->getApplication()->trans('amazonpay.payment.failed'));

        return [
            'redirectUrl' => $this->getApplication()->path(CartControllerProvider::ROUTE_CART)
        ];
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
