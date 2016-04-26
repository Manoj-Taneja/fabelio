<?php

class Magefast_RemoveCrumbs_Block_Html_Breadcrumbs extends Mage_Page_Block_Html_Breadcrumbs
{
    /**
     * Remove breadcrumbs
     *
     * @param string $name
     * @return $this
     */
    public function removeCrumbs($name = 'product')
    {
        unset($this->_crumbs[$name]);
        return $this;
    }

}
