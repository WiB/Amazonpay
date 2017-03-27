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
        $quote->setAmazonpayPayment($amazonPaymentTransfer);
        $quote = $this->getClient()->handleCartWithAmazonpay($quote);
        $this->getFactory()->getQuoteClient()->setQuote($quote);

        $stepBreadcrumbsTransfer = $this->getFactory()
            ->getCheckoutBreadcrumbPlugin()
            ->generateStepBreadcrumbs($quote);

        return [
            'quoteTransfer' => $quote,
            'stepBreadcrumbs' => $stepBreadcrumbsTransfer,
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
        $quote->getAmazonpayPayment()->setOrderReferenceId($request->request->get('reference_id'));

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
        $this->getFactory()->getQuoteClient()->setQuote($quote);
        $shipmentMethods = $this->getFactory()->getShipmentClient()->getAvailableMethods($quote);

        return [
            'shipmentMethods' => $shipmentMethods->getMethods(),
        ];
    }

    /**
     * @param Request $request
     *
     * @return []
     */
    public function updateShipmentMethodAction(Request $request)
    {
        $quote = $this->getFactory()->getQuoteClient()->getQuote();
        $quote->getShipment()->setShipmentSelection((int) $request->request->get('shipment_method_id'));
        $quote = $this->getClient()->addSelectedShipmentMethodToQuote($quote);
        $quote = $this->getFactory()->getCalculationClient()->recalculate($quote);
        $this->getFactory()->getQuoteClient()->setQuote($quote);

        return [
            'quoteTransfer' => $quote,
        ];
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
            return $this->getFailedRedirectResponse();
        }

        $quote = $this->getClient()->confirmPurchase($quote);
        $quote = $this->getFactory()->getCalculationClient()->recalculate($quote);
        $this->getFactory()->getQuoteClient()->setQuote($quote);

        if ($quote->getAmazonpayPayment()->getResponseHeader()->getIsSuccess()) {
            if (!$quote->getAmazonpayPayment()->getAuthorizationDetails()->getIsDeclined()) {
                $checkoutResponseTransfer = $this->getFactory()->getCheckoutClient()->placeOrder($quote);

                if ($checkoutResponseTransfer->getIsSuccess()) {
                    return $this->redirectResponseInternal(AmazonpayControllerProvider::SUCCESS);
                }

                //@todo implement proper error handling (if neccessary)
                return new Response('Persisting Order Error');
            }

            if ($quote->getAmazonpayPayment()->getAuthorizationDetails()->getIsPaymentMethodInvalid()) {
                return $this->redirectResponseInternal(AmazonpayControllerProvider::CHANGE_PAYMENT_METHOD);
            } else {
                return $this->getFailedRedirectResponse();
            }
        }

        if ($quote->getAmazonpayPayment()->getResponseHeader()->getConstraints()) {
            return $this->redirectResponseExternal($request->headers->get('referer'));
        }

        // @todo maybe generate a more detailed message based on constraints (if any)
        return $this->getFailedRedirectResponse();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function getFailedRedirectResponse()
    {
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
     * @return array
     */
    public function successAction(Request $request)
    {
        $this->getFactory()->getQuoteClient()->clearQuote();

        $stepBreadcrumbsTransfer = $this->getFactory()
            ->getCheckoutBreadcrumbPlugin()
            ->generateStepBreadcrumbs($this->getFactory()->getQuoteClient()->getQuote());

        return [
            'stepBreadcrumbs' => $stepBreadcrumbsTransfer,
        ];
    }

}
