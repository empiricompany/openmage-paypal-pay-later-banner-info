<?php

/**
 * Copyright (c) 2011-2019 SAS WEB COOKING - Vincent René Lucien Enjalbert. All rights reserved.
 * See LICENSE-EN.txt for license details.
 */
class MM_Paypalpaylater_Model_Adminhtml_System_Config_Source_Color extends Varien_Object
{


    public function toOptionArray()
    {
        
        $options = array();
        $options[] = array(
            'value' => 'black',
            'label' => 'black - Default. Black text with colored logo'
        );
        $options[] = array(
            'value' => 'white',
            'label' => 'white - White text with a white logo'
        );
        $options[] = array(
            'value' => 'monochrome',
            'label' => 'monochrome - Black text with a black logo'
        );
        $options[] = array(
            'value' => 'grayscale',
            'label' => 'grayscale - Black text with a grayscale logo'
        );

        
        return $options;
    }
}

