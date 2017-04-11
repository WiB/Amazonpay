<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Communication\Controller;

use Symfony\Component\HttpFoundation\Response;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

/**
 * @method \Spryker\Zed\Amazonpay\Business\AmazonpayFacade getFacade()
 */
class IpnController extends AbstractController
{
    /**
     * @return Response
     */
    public function endpointAction()
    {
        $headers = getallheaders();
        $body = file_get_contents('php://input');

        $ipnRequestTransfer = $this->getFacade()->convertAmazonpayIpnRequest($headers, $body);
        $this->getFacade()->handleAmazonpayIpnRequest($ipnRequestTransfer);

        return new Response('Request has been processed');
    }

}
