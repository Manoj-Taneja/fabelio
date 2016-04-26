<?php
/**
 * Minigrid system config field element type
 * Displays the minigid in a usable backend fashion. Requires a source
 * model to properly display;
 *
 * @package     BlueAcorn\MiniGrid
 * @version     1.1.0
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Blue Acorn, Inc. 2014
 */
class BlueAcorn_MiniGrid_Block_System_Config_Form_Field_Minigrid extends Varien_Data_Form_Element_Abstract {

    /**
     * Add the js block which contains the js that makes
     * the mini grids work only once to the admin js
     * block
     */
    protected function _addJsIfNecessary() {
        $alias = 'ba.mini.grid.js';
        $block = Mage::app()->getLayout()->createBlock("baminigrid/System_Config_Form_Field_Minigrid_Js", $alias);

        $js = Mage::app()->getLayout()->getBlock('js');
        if (!$js->getChild($alias)) {
            Mage::app()->getLayout()->getBlock('js')->append($block, $alias);
        }
    }

    /**
     * Default values of field array. Field array defines
     * the fields on the grid.
     *
     * @return array
     */
    protected function _getDefaultSourceValues() {
        return array(
            "{$this->getLabel()}" => array("width" => "98%", "type" => "text"),
        );
    }

    /**
     * Element rendererd html. Called by getDefaultHtml which combines
     * the label html with this html to render the full element. Specifically,
     * this is the html to render the field input
     *
     * @var $fields Fields is the array of minigrid columns and fields
     *              Fields is represented by $this->getValues()
     * @var $rowData The row data is an array of values of already existant
     *                  grid rows. Row data is represented with $this->getValue();
     *
     * NOTE: We are breaking php runtime to fall into html directly
     * in this function instead of using a template to keep this module
     * succinct, contained, and to avoid rendering html/js via strings
     * as is the convention for form and form element renderers.
     *
     * Providing optional parameters for required inputs if this block is being
     * used outside of its normal use case (such as outside of system config)
     *
     * @param string $label
     * @param string $tableId
     * @param string $fieldName
     * @param array $fields
     * @param array $rowData
     *
     * @return string
     */
    public function getElementHtml($tableId = null, $fieldName = null, $fields = array(), $rowData = array()) {

        $this->_addJsIfNecessary();

        $label = $this->getLabel();
        $tableId = ($tableId) ? $tableId : $this->getHtmlId();
        $fieldName = ($fieldName) ? $fieldName : $this->getName();

        $fields = (empty($fields)) ? $this->getValues() : $fields;
        if (!$fields) {
            $fields = $this->_getDefaultSourceValues();
        }
        $rowData = (empty($rowData)) ? $this->getValue() : $rowData;
        if (!is_array($rowData)) {
            $rowData = array();
        }
        ob_start();
        ?>
    <div class="grid">
        <table id="ba-<?php echo $tableId?>-table" class="option-header" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="headings">
                    <?php foreach($fields as $header => $def) :?>
                    <th style="width:<?php echo $def['width'];?>"><?php echo ucwords(str_replace("_"," ",$header))?></th>
                    <?php endforeach;?>
                    <th style="width:30px">Remove</th>
                </tr>
            </thead>
            <tbody id="ba-<?php echo $tableId?>">
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="<?php echo count($fields) + 1?>" class="a-right">
                    <button id="ba-add-<?php echo $tableId?>" class="scalable add" type="button"><span>Add <?php echo ucwords($label)?></span></button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

<script type="text/javascript">
Event.observe(window,'load', function(){
    (new baMiniGrid()).init($("ba-<?php echo $tableId?>"),
    $('ba-add-<?php echo $tableId?>'),
    "<?php echo $fieldName?>",
    <?php echo json_encode($rowData)?>,
    <?php echo json_encode($fields)?>);
});
</script>
        <?php
        return ob_get_clean();
    }
}
