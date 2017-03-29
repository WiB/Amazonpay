<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\Amazonpay\Controller;

use Generated\Shared\Transfer\AmazonpayPaymentTransfer;
use Spryker\Yves\Amazonpay\Plugin\Provider\AmazonpayControllerProvider;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method \Spryker\Yves\Amazonpay\AmazonpayFactory getFactory()
 * @method \Spryker\Client\Amazonpay\AmazonpayClient getClient()
 */
class PaymentController extends AbstractController
{

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
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

        return [
            'quoteTransfer' => $quote,
        ];
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function setOrderReferenceAction(Request $request)
    {
        $quote = $this->getFactory()->getQuoteClient()->getQuote();
        $quote->getAmazonpayPayment()->setOrderReferenceId($request->request->get('reference_id'));

        return new JsonResponse(['success' => true]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
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
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function updateShipmentMethodAction(Request $request)
    {
        $quote = $this->getFactory()->getQuoteClient()->getQuote();
        $quote->getShipment()->setShipmentSelection((int)$request->request->get('shipment_method_id'));
        $quote = $this->getClient()->addSelectedShipmentMethodToQuote($quote);
        $quote = $this->getFactory()->getCalculationClient()->recalculate($quote);
        $this->getFactory()->getQuoteClient()->setQuote($quote);

        return [
            'quoteTransfer' => $quote,
        ];
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
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

                //@todo implement proper error handling (if necessary)
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

        return $this->redirectResponseInternal('cart');
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function changePaymentMethodAction(Request $request)
    {
        $quote = $this->getFactory()->getQuoteClient()->getQuote();

        return [
            'quoteTransfer' => $quote,
        ];
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function successAction(Request $request)
    {
        $this->getFactory()->getQuoteClient()->clearQuote();

        return [];
    }

}
