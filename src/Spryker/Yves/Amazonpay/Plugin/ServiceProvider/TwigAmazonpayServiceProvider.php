<?php
namespace Spryker\Yves\Amazonpay\Plugin\ServiceProvider;

use Silex\ServiceProviderInterface;
use Silex\Application;
use Spryker\Yves\Kernel\AbstractPlugin;

/**
 * @method \Spryker\Yves\Amazonpay\AmazonpayFactory getFactory()
 */
class TwigAmazonpayServiceProvider extends AbstractPlugin implements ServiceProviderInterface
{
    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    public function register(Application $app)
    {
        $app['twig'] = $app->share(
            $app->extend('twig', function (\Twig_Environment $twig) {
                    $twig->addFunction($this->getAmazonpayButtonFunction());
    //                $twig->addFunction($this->getAmazonpaySelectionWidgetsFunction());
    //                $twig->addFunction($this->getAmazonpayPaymentWidgetFunction());

                    return $twig;
                },
                ['needs_environment' => true]
            )
        );
    }

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    public function boot(Application $app)
    {
    }

    protected function getAmazonpayButtonFunction()
    {
        $amazonpayConfig = $this->getFactory()->getConfig();

        $function = new \Twig_SimpleFunction('pay_with_amazon',
            function(\Twig_Environment $environment) use ($amazonpayConfig) {
                $html = <<<EOD
<div id="AmazonPayButton" align="center"></div>
<script>
    window.onAmazonLoginReady = function() {
        amazon.Login.setClientId('%client_id%');
    };

    window.onAmazonPaymentsReady = function(){
        // render the button here
        var authRequest;
        var addressConsentToken;

        OffAmazonPayments.Button('AmazonPayButton', '%seller_id%', {
            type:  'PwA',
            color: 'Gold',
            size:  'medium',
            language: 'en-GB',

            authorization: function() {
                loginOptions = {scope: 'profile postal_code payments:widget payments:shipping_address payments:billing_address', popup: true};
                authRequest = amazon.Login.authorize (loginOptions, function(response) {
                    addressConsentToken = response.access_token;
                });
            },

            onSignIn: function (orderReference) {
                var referenceId = orderReference.getAmazonOrderReferenceId();

                if (!referenceId) {
                    errorHandler(new Error('referenceId missing'));
                } else {
                    window.location = '/amazonpay/checkout' + '?referenceId=' +
                        orderReference.getAmazonOrderReferenceId() +
                        "&access_token=" + addressConsentToken;
                }
            },
        });
    }
</script>
<script async="async"
        src='https://static-eu.payments-amazon.com/OffAmazonPayments/eur/sandbox/lpa/js/Widgets.js'>
</script>
EOD;


            }
        );

        return $function;
    }

    protected function getAmazonpaySelectionWidgetsFunction()
    {

    }

    protected function getAmazonpayPaymentWidgetFunction()
    {

    }

}