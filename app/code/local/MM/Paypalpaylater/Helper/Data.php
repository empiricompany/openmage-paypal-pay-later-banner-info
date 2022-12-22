<?php
class MM_Paypalpaylater_Helper_Data extends Mage_Core_Helper_Abstract {
	

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