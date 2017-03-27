<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger;

use Generated\Shared\Transfer\AmazonpayResponseHeaderTransfer;

interface TransactionLoggerInterface
{
    public function log(AmazonpayResponseHeaderTransfer $headerTransfer);
}
