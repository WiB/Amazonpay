<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\QuoteTransfer;
use PayWithAmazon\Client;
use PayWithAmazon\ResponseParser;
use Spryker\Zed\Amazonpay\AmazonpayConfig;

class AmazonpayAdapter implements AmazonpayAdapterInterface
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(AmazonpayConfig $config)
    {
        $config = [
            'merchant_id'   => $config->getSellerId(),
            'access_key'    => $config->getAccessKeyId(),
            'secret_key'    => $config->getSecretAccessKey(),
            'client_id'     => $config->getClientId(),
            'region'        => $config->getRegion(),
            'sandbox'       => true
        ];

        $this->client = new Client($config);
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return ResponseParser
     */
    public function setOrderReferenceDetails(QuoteTransfer $quoteTransfer)
    {
        $result = $this->client->setOrderReferenceDetails([
            'amazon_order_reference_id' => $quoteTransfer->getAmazonOrderReferenceId(),
            'amount' => $quoteTransfer->getTotals()->getGrandTotal(),
            'currency_code' =>  'EUR',
        ]);

        return $result;
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return ResponseParser
     */
    public function confirmOrderReference(QuoteTransfer $quoteTransfer)
    {
        $result = $this->client->confirmOrderReference([
            'amazon_order_reference_id' => $quoteTransfer->getAmazonOrderReferenceId(),
        ]);

        return $result;
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return ResponseParser
     */
    public function getOrderReferenceDetails(QuoteTransfer $quoteTransfer)
    {
        $result = $this->client->getOrderReferenceDetails([
            'amazon_order_reference_id' => $quoteTransfer->getAmazonOrderReferenceId(),
        ]);

        return $result;
    }
}