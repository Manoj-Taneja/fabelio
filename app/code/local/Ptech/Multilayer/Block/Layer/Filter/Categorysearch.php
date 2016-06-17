<?php
/**
 * Ptech Multi Select Layer Navigation
 *  
 * @category     Ptech
 * @package      Ptech_Multilayer 
 * @copyright    Copyright (c) 2014-2015 Ptech
 * @author       Ptech (Brijesh Kumar)  
 * @version      Release: 1.0.0
 * @Class        Ptech_Multilayer_Block_Layer_Filter_Categorysearch
 * @Overwrite    Ptech_Multilayer_Block_Layer_Filter_Category
 */ 

class Ptech_Multilayer_Block_Layer_Filter_Categorysearch extends Ptech_Multilayer_Block_Layer_Filter_Category
{
    public function __construct()
    {

        parent::__construct();
		//Load Custom PHTML of category search
        $this->setTemplate('multilayer/filter_category_search.phtml');
		//Set Filter Model Name
        $this->_filterModelName = 'multilayer/layer_filter_categorysearch'; 
    }
    
} 
