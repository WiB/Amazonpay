<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler;

use Generated\Shared\Transfer\AmazonpayResponseHeaderTransfer;
use Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpayApiLog;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class TransactionLogger
{
    const REPORT_LEVEL_ALL = 'ALL';
    const REPORT_LEVEL_ERRORS_ONLY = 'ERRORS_ONLY';
    const REPORT_LEVEL_DISABLED = 'DSABLED';

    /**
     * @var int
     */
    protected $reportLevel;

    /**
     * @param $reportLevel
     */
    public function __construct($reportLevel)
    {
        $this->reportLevel = $reportLevel;
    }

    /**
     * @param AbstractTransfer $responseTransfer
     *
     * @return bool
     */
    protected function isLoggable(AbstractTransfer $responseTransfer)
    {
        if ($this->reportLevel === self::REPORT_LEVEL_ALL) {
            return true;
        };

        if ($this->reportLevel === self::REPORT_LEVEL_DISABLED) {
            return true;
        };

        if ($this->reportLevel === self::REPORT_LEVEL_ERRORS_ONLY) {
            return !$responseTransfer->getHeader()->isSuccess();
        }
    }
    
    public function log(AbstractTransfer $responseTransfer) 
    {
        /** @var AmazonpayResponseHeaderTransfer $responseTransfer */
        $header = $responseTransfer->getHeader();

        if (!$this->isLoggable($responseTransfer)) {
            return;
        }

        $logEntity = new SpyPaymentAmazonpayApiLog();
        $logEntity->setStatusCode($header->getStatusCode());
        $logEntity->setRequestId($header->getRequestId());

    }
}
