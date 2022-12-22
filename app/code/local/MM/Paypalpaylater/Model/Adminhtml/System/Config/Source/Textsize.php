<?php

/**
 * Copyright (c) 2011-2019 SAS WEB COOKING - Vincent René Lucien Enjalbert. All rights reserved.
 * See LICENSE-EN.txt for license details.
 */
class MM_Paypalpaylater_Model_Adminhtml_System_Config_Source_Textsize extends Varien_Object
{


    public function toOptionArray()
    {
        
        $options = array();
        $options[] = array(
            'value' => '10',
            'label' => '10 - Smaller text sizes.'
        );
        $options[] = array(
            'value' => '11',
            'label' => '11 - Smaller text sizes.'
        );
        $options[] = array(
            'value' => '12',
            'label' => '12 - SDk Default. Standard text size.'
        );
        $options[] = array(
            'value' => '13',
            'label' => '13 - Larger text sizes.'
        );
        $options[] = array(
            'value' => '14',
            'label' => '14 - Larger text sizes.'
        );
        $options[] = array(
            'value' => '15',
            'label' => '15 - Larger text sizes.'
        );
        $options[] = array(
            'value' => '16',
            'label' => '16 - Larger text sizes.'
        );

        
        return $options;
    }
}

