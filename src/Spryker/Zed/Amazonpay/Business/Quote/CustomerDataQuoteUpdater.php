<?php
namespace Spryker\Zed\Amazonpay\Business\Quote;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\ObtainProfileInformationAdapter;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\QuoteAdapterInterface;

class CustomerDataQuoteUpdater implements QuoteUpdaterInterface
{
    /**
     * @var CustomerTransfer
     */
    protected $apiResponse;

    /**
     * @var ObtainProfileInformationAdapter
     */
    protected $executionAdapter;

    /**
     * @var AmazonpayConfig
     */
    protected $config;

    /**
     * @param QuoteAdapterInterface $executionAdapter
     * @param AmazonpayConfig $config
     */
    public function __construct(
        QuoteAdapterInterface $executionAdapter,
        AmazonpayConfig $config
    ) {
        $this->executionAdapter = $executionAdapter;
        $this->config = $config;
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function update(QuoteTransfer $quoteTransfer)
    {
        $this->apiResponse = $this->executionAdapter->call($quoteTransfer);
        $quoteTransfer->setCustomer($this->apiResponse);

        //@todo as long as we don't have proper social login via amazon, let's do this:
        $quoteTransfer->getCustomer()->setIsGuest(true);

        return $quoteTransfer;
    }

}
