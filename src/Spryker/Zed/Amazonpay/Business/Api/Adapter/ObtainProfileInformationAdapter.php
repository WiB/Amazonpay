<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Converter\AbstractArrayConverter;

class ObtainProfileInformationAdapter extends AbstractAdapter implements QuoteAdapterInterface
{
    /**
     * @var AbstractArrayConverter
     */
    protected $converter;

    public function __construct(
        AmazonpayConfig $config,
        AbstractArrayConverter $converter
    ) {
        parent::__construct($config);

        $this->converter = $converter;
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return CustomerTransfer
     */
    public function call(QuoteTransfer $quoteTransfer)
    {
        $result = $this->client->getUserInfo($quoteTransfer->getAmazonpayPayment()->getAddressConsentToken());

        return $this->converter->convert($result);
    }
}
