<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger;

use Generated\Shared\Transfer\AmazonpayResponseHeaderTransfer;
use Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpayApiLog;

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
     * @param AmazonpayResponseHeaderTransfer $headerTransfer
     *
     * @return bool
     */
    protected function isLoggable(AmazonpayResponseHeaderTransfer $headerTransfer)
    {
        if ($this->reportLevel === self::REPORT_LEVEL_ALL) {
            return true;
        };

        if ($this->reportLevel === self::REPORT_LEVEL_DISABLED) {
            return false;
        };

        if ($this->reportLevel === self::REPORT_LEVEL_ERRORS_ONLY) {
            return !$headerTransfer->getIsSuccess();
        }
    }

    /**
     * @param AmazonpayResponseHeaderTransfer $headerTransfer
     */
    public function log(AmazonpayResponseHeaderTransfer $headerTransfer)
    {
        if (!$this->isLoggable($headerTransfer)) {
            return;
        }

        $logEntity = new SpyPaymentAmazonpayApiLog();
        $logEntity->setStatusCode($headerTransfer->getStatusCode());
        $logEntity->setRequestId($headerTransfer->getRequestId());
        $logEntity->setErrorMessage($headerTransfer->getErrorMessage());
        $logEntity->setErrorCode($headerTransfer->getErrorCode());
        $logEntity->save();
    }
}
