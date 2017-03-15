<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Converter\AbstractResponseParserConverter;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface;

abstract class AbstractQuoteAdapter extends AbstractAdapter implements QuoteAdapterInterface
{
    /**
     * @var AbstractResponseParserConverter
     */
    protected $converter;

    /**
     * @var AmazonpayToMoneyInterface
     */
    protected $moneyFacade;

    public function __construct(
        AmazonpayConfig $config,
        AbstractResponseParserConverter $converter,
        AmazonpayToMoneyInterface $moneyFacade
    ) {
        parent::__construct($config);

        $this->converter = $converter;
        $this->moneyFacade = $moneyFacade;
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return float
     */
    protected function getAmount(QuoteTransfer $quoteTransfer)
    {
        return $this->moneyFacade->convertIntegerToDecimal(
            $quoteTransfer->requireTotals()->getTotals()->getGrandTotal()
        );
    }

}
