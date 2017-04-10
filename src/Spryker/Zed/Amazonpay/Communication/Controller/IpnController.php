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
        // it's better to have some class for the to lines bellow
        $headers = getallheaders();
        $body = file_get_contents('php://input');

        $ipnRequestTransfer = $this->getFacade()->convertAmazonpayIpnRequest($headers, $body);
        $this->getFacade()->handleAmazonpayIpnRequest($ipnRequestTransfer);

//        $ipnHandler = new IpnHandler($headers, $body);
//        file_put_contents('ipn.txt', json_encode($ipnHandler->toArray()));
//        file_put_contents('headers.txt', serialize($headers));
//        file_put_contents('body.txt', serialize($body));

        return new Response('Request has been processed');
    }

}
