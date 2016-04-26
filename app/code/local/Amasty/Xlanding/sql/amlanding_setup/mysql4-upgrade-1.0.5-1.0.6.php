<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */
$this->startSetup();

 $pagesData = $this->getConnection()->fetchAll("
        SELECT
            page_id, attributes
        FROM
            {$this->getTable('amlanding/page')}
    ");
   foreach ($pagesData as $page) {
    	$pageId = $page['page_id'];
    	$attributes = $page['attributes'];
    	
    	if (empty($attributes)) {
    		continue;
    	}
    	/*
    	 * Old Format:
    	 * a:2:{s:12:"manufacturer";a:1:{i:0;s:3:"117";}s:5:"color";a:1:{i:0;s:2:"23";}}
    	 * 
    	 * OR
    	 *  
    	 * Array
			(
			[manufacturer] => Array
			(
			[0] => 117
			)
			
			[color] => Array
			(
			[0] => 23
			)
			
			)

    	 */
    	$deserialize = unserialize($attributes);
    	
    	$newFormat = array();
    	foreach ($deserialize as $code => $options) {
    		foreach ($options as $option) {
    			$newFormat[] = array(
    				'code' => $code,
    				'value' => $option,
    				'cond' => 'eq'
    			);	
    		}
    	}
    	
    	$serialize = serialize($newFormat);
    	
        $query = "
                UPDATE `{$this->getTable('amlanding/page')}`
                    SET `attributes` = '" . $serialize . "'
                    WHERE `page_id` = $pageId;
            ";
        
		$this->run($query);
    }

$this->endSetup();