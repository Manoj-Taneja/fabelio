<?php

/**
 * @package     BlueAcorn\Optimizely
 * @version     1.1.0
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Blue Acorn, Inc. 2014
 */
class BlueAcorn_Optimizely_Block_Head extends Mage_Page_Block_Html_Head
{
    /**
     * This will inject the optimizely embed payload into the top of the head tag and remove it from the block stack.
     * If this isn't ran for some reason, the layout updates should ensure this is still rendered somewhere within
     * the head tag.
     *
     * I considered using an observer here, but core_block_abstract_to_html_before seems to be  the only good canidate and this
     * feels more surgical, considering there's a fallback mechanism in place if there's a rewrite that supercedes this.
     *
     * @return string
     */
    public function _toHtml()
    {
        $embed = $this->getChildHtml('optimizely_head');
        if($embed) $this->unsetChild('optimizely_head');
        return $embed.parent::_toHtml();
    }
}