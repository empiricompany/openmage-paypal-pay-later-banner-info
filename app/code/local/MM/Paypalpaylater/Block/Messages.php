<?php
class MM_Paypalpaylater_Block_Messages extends Mage_Core_Block_Template {

    /**
     * Whether the block should be eventually rendered
     *
     * @var bool
     */
    protected $_shouldRender = true;

    /**
     * Payment method code
     *
     * @var string
     */
    protected $_paymentMethodCode = Mage_Paypal_Model_Config::METHOD_WPP_EXPRESS;

    const SDK_SRC = 'https://www.paypal.com/sdk/js?client-id=%s&locale=%s&currency=%s&components=messages&enable-funding=paylater';

    public function getSrcSdk() {

        return sprintf( MM_Paypalpaylater_Block_Messages::SDK_SRC,

            Mage::helper('mm_paypalpaylater')->getClientId(),
            Mage::app()->getLocale()->getLocaleCode(),
            Mage::app()->getStore()->getCurrentCurrencyCode()
        );
    }

    public function getAmount() {
        /** @var Mage_Catalog_Model_Product $currentProduct */
        $currentProduct = Mage::registry('current_product');

        $quote = Mage::getSingleton('checkout/session')->getQuote();

        switch(true) {
            case !is_null($currentProduct):
                return Mage::registry('current_product')->getFinalPrice();
            break;

            case !is_null($quote):
                return $quote->getGrandTotal();
            break;
        }

        return 0;

    }

	/**
     * @return Mage_Core_Block_Abstract
     */
    protected function _beforeToHtml()
    {
        $result = parent::_beforeToHtml();
        
        if( !Mage::helper('mm_paypalpaylater')->getClientId()) {
            $this->_shouldRender = false;
            return $result;
        }

        if( $this->getAmount() < Mage::helper('mm_paypalpaylater')->getMinimumAmount() ) {
            $this->_shouldRender = false;
            return $result;
        }

        $isInCatalog = $this->getIsInCatalogProduct();
        $quote = ($isInCatalog || '' == $this->getIsQuoteAllowed())
            ? null : Mage::getSingleton('checkout/session')->getQuote();

        // check visibility on cart or product page
        $context = $isInCatalog ? 'visible_on_product' : 'visible_on_cart';
        switch($context) {
            case 'visible_on_product':
                if( !Mage::helper('mm_paypalpaylater')->isVisibleOnProductPage() ) {
                    $this->_shouldRender = false;
                    return $result;        
                }
            break;
            case 'visible_on_cart':
            default:
                if( !Mage::helper('mm_paypalpaylater')->isVisibleOnCartPage() ) {
                    $this->_shouldRender = false;
                    return $result;        
                }
            break;
        }

        if ($isInCatalog) {
            /** @var Mage_Catalog_Model_Product $currentProduct */
            $currentProduct = Mage::registry('current_product');
            if (!is_null($currentProduct)) {
                $price = (float)$currentProduct->getFinalPrice();
                $typeInstance = $currentProduct->getTypeInstance();
                if (empty($price) && !$currentProduct->isSuper() && !$typeInstance->canConfigure($currentProduct)) {
                    $this->_shouldRender = false;
                    return $result;
                }
            }
        }

        // validate minimum quote amount and validate quote for zero grandtotal
        if (null !== $quote && (!$quote->validateMinimumAmount()
            || (!$quote->getGrandTotal() && !$quote->hasNominalItems()))) {
            $this->_shouldRender = false;
            return $result;
        }

        // check payment method availability
        $methodInstance = Mage::helper('payment')->getMethodInstance($this->_paymentMethodCode);
        if (!$methodInstance || !$methodInstance->isAvailable($quote)) {
            $this->_shouldRender = false;
            return $result;
        }

        return $result;
    }

    /**
     * Render the block if needed
     *
     * @return string
     */
    protected function _toHtml()
    {
        if (!$this->_shouldRender) {
            return '';
        }
        return parent::_toHtml();
    }
}