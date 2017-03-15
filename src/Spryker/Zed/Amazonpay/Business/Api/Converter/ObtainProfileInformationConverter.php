<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\CustomerTransfer;

class ObtainProfileInformationConverter extends AbstractArrayConverter
{
    /**
     * @param array $response
     *
     * @return CustomerTransfer
     */
    public function convert(array $response)
    {
        $responseTransfer = new CustomerTransfer();
        
        if (!empty($response['name'])) {
            $responseTransfer = $this->updateNameData($responseTransfer, $response['name']);
        }

        if (!empty($response['email'])) {
            $responseTransfer->setEmail($response['email']);
        }

        return $responseTransfer;
    }

}
