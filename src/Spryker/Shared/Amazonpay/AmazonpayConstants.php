<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\Amazonpay;

interface AmazonpayConstants
{

    const ACCESS_KEY_ID = 'ACCESS_KEY_ID';
    const CLIENT_ID = 'CLIENT_ID';
    const SELLER_ID = 'SELLER_ID';
    const SECRET_ACCESS_KEY = 'SECRET_ACCESS_KEY';
    const CLIENT_SECRET = 'CLIENT_SECRET';
    const SANDBOX = 'SANDBOX';
    const REGION = 'DE';
    const STORE_NAME = 'STORE_NAME';
    const CURRENCY_CODE = 'EUR';
    const ERROR_REPORT_LEVEL = 'ERROR_REPORT_LEVEL';

    const PAYMENT_METHOD = 'Amazon Pay';
    const PROVIDER_NAME = 'Amazon Pay';

    const OMS_STATUS_NEW = 'new';
    const OMS_STATUS_AUTHORIZED = 'authorized';
    const OMS_STATUS_DECLINED = 'declined';
    const OMS_STATUS_CAPTURED = 'captured';
    const OMS_STATUS_CANCELLED = 'cancelled';
    const OMS_STATUS_CLOSED = 'closed';
    const OMS_STATUS_REFUNDED = 'refunded';

}
