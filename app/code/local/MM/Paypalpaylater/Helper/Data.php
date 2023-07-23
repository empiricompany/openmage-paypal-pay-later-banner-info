<?php
class MM_Paypalpaylater_Helper_Data extends Mage_Core_Helper_Abstract {
	
	const SDK_SRC = 'https://www.paypal.com/sdk/js?client-id=%s&locale=%s&currency=%s&components=messages&enable-funding=paylater';

	public function getSrcSdk() {
		$url = sprintf( MM_Paypalpaylater_Helper_Data::SDK_SRC,
            $this->getClientId(),
            Mage::app()->getLocale()->getLocaleCode(),
            Mage::app()->getStore()->getCurrentCurrencyCode()
        );
		$return = "<![CDATA[<script>";
		$return.= "var PAYPAL_SCRIPT = '".$url."';";
		$return.= "var sp = document.createElement('script');";
		$return.= "sp.setAttribute('src', PAYPAL_SCRIPT);";
		$return.= "sp.setAttribute('defer', true);";
		$return.= "document.head.appendChild(sp);";
		$return.= "</script>]]>";
		return $return;

    }

	public function getConfig($path = null) {
		return Mage::getStoreConfig('mm_paypalpaylater/'.$path);
	}

	public function getClientId() {
		return $this->getConfig('general/client_id');
	}

	public function isVisibleOnProductPage() {
		return $this->getConfig('general/visible_on_product');
	}

	public function isVisibleOnCartPage() {
		return $this->getConfig('general/visible_on_cart');
	}

	public function getMinimumAmount() {
		return $this->getConfig('style/minimum_amount');
	}

    public function getLogoType() {
        return $this->getConfig('style/logotype');
    }

    public function getColor() {
        return $this->getConfig('style/color');
    }

    public function getTextsize() {
        return $this->getConfig('style/textsize');
    }
	
}