<?php
namespace Spryker\Yves\Amazonpay\Controller;

use Spryker\Yves\Kernel\Controller\AbstractController;

class WidgetController extends AbstractController
{
    public function payButtonAction()
    {
        return [
            'amazonConfig' => $this->getFactory()->getConfig()
        ];

    }

    public function checkoutWidgetAction()
    {
        return [
            'amazonConfig' => $this->getFactory()->getConfig()
        ];

    }

    public function walletWidgetAction()
    {
        return [
            'amazonConfig' => $this->getFactory()->getConfig()
        ];

    }

}