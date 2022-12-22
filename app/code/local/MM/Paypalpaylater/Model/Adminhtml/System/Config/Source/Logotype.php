<?php

/**
 * Copyright (c) 2011-2019 SAS WEB COOKING - Vincent René Lucien Enjalbert. All rights reserved.
 * See LICENSE-EN.txt for license details.
 */
class MM_Paypalpaylater_Model_Adminhtml_System_Config_Source_Logotype extends Varien_Object
{


    public function toOptionArray()
    {
        
        $options = array();
        $options[] = array(
            'value' => 'primary',
            'label' => 'primary - SDK Default. Full PayPal Logo.'
        );
        $options[] = array(
            'value' => 'alternative',
            'label' => 'alternative - PayPal monogram Logo.'
        );
        $options[] = array(
            'value' => 'inline',
            'label' => 'inline - Single line PayPal Logo without monogram.'
        );
        $options[] = array(
            'value' => 'none',
            'label' => 'none - No logo. Text only.'
        );

        
        return $options;
    }
}

