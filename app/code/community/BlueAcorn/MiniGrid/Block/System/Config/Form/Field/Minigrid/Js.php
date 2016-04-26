<?php
/**
 * Minigrid form field js
 * Javascript that controls the forms
 *
 * @package     BlueAcorn\MiniGrid
 * @version     1.1.0
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Blue Acorn, Inc. 2014
 */
class BlueAcorn_MiniGrid_Block_System_Config_Form_Field_Minigrid_Js extends Mage_Core_Block_Text {


    /**
     * Output the JS that controls the minigrids
     *
     * NOTE: We are breaking php runtime to fall into html directly
     * in this function instead of using a template to keep this module
     * succinct, contained, and to avoid rendering html/js via strings
     * as is the convention for form and form element renderers.
     *
     * @use (new baMiniGrid()).init(tbody, addRowButton, rowName, collectionData, rowData);
     * @return string
     */
    protected function _toHtml() {

        $html = parent::_toHtml();
        $successIcon = $this->getSkinUrl('images/success_msg_icon.gif');
        ob_start();
    ?>
<script type="text/javascript">

function baMiniGrid() {
    return {
        /**
         * @param tbody Body tag of grid table to insert rows into
         * @param addRowButton Button that adds rows to grid
         * @param rowName Unique name to give the grid rows. Used in name attribute
         * @param collectionData Object that has info on all prexisting grid rows
         * @param rowData Object containing the schema of the columns in each row
         */
        init : function(tbody, addRowButton, rowName, collectionData, rowData) {
            this.tbody = tbody;
            this.addRowButton = addRowButton;
            this.collectionData = collectionData;
            this.rowData = rowData;
            this.rowName = rowName;

            this.initRows();
            this.observeAddRowButton();
        },
        observeAddRowButton : function () {
            this.addRowButton.observe('click', function(ev){
                ev.stop();
                this.addRow();
            }.bind(this));
        },
        getNewRowId : function () {
            if (typeof this.rowId == "undefined") {
                this.rowId = 0;
            }
            return this.tbody.id+"-row-id-"+this.rowId++;
        },
        initRows : function () {
            if (!this.collectionData.length || this.collectionData.length < 1) {
                return;
            }
            this.collectionData.each(function(rowValues) {
                var row = this.getNewRow(rowValues);
                this.addRow(row);
            }.bind(this));
        },
        getNewRow : function (rowValues) {
            var rowId = this.getNewRowId();
            var rowName = this.rowName;

            var tr = new Element('tr', {id: rowId});
            var td, input;
            for (var field in this.rowData) {
                td = new Element('td');
                input = this.getInputTag(field, rowName, rowId);
                if (rowValues && typeof rowValues[field] != 'undefined') {
                    try {
                        input.value = rowValues[field];
                        delete rowValues[field];
                    }
                    catch (e) {
                        if (input.type == "file") {
                            var fileUploaded = new Element('div', {style:"float:left; width:16px; height:16px; background: url('<?php echo $successIcon ?>') no-repeat 0 0;"});
                            var uploaded = new Element('p', {style:"float:left; margin:0 0 0 5px"}).update("File Uploaded.");
                            Element.insert(td, {bottom: fileUploaded});
                            Element.insert(td, {bottom: uploaded});
                            td.setAttribute("title", "File: " + rowValues[field]);
                        }
                    }
                }

                Element.insert(td, {bottom: input});
                Element.insert(tr, {bottom: td});
            }

            if (rowValues && typeof rowValues != 'undefined') {
                for (var field in rowValues) {
                    Element.insert(tr, {top: new Element('input', {name:this.rowName + "["+rowId+"]["+field+"]", type:"hidden", value:rowValues[field]})})
                }
            }

            var button = new Element('button', {type: 'button', style: 'width:50px;', title: 'Delete'}).update("<span>Delete</span>");
            button.className = "scalable delete icon-btn";
            button.observe('click', function(ev) {
                ev.stop();
                this.removeRow(rowId);
            }.bind(this));

            var buttonTd = new Element('td');
            Element.insert(buttonTd, {bottom: button});
            Element.insert(tr, {bottom: buttonTd});
            return tr;
        },
        getInputTag : function (field, rowName, rowId) {
            var input;
            if (this.rowData[field]['type'] == 'textarea' || this.rowData[field]['type'] == "select") {
                input = new Element(this.rowData[field]['type'], {style:"width:98%;",name: rowName + "["+rowId+"][" +field + "]"});
                input.addClassName("minigrid-field");
                input.addClassName("minigrid-field-" + field);
                if (typeof this.rowData[field]['options'] != 'undefined') {
                    var options = this.rowData[field]['options'];
                    if (Object.isArray(options)) {
                        options.each(function(value,opt){
                            var option = new Element('option', {value: opt}).update(value);
                            Element.insert(input, {bottom: option});
                        }.bind(this));
                    }
                    else {
                        for (var opt in options) {
                            var option = new Element('option', {value: opt}).update(options[opt]);
                            Element.insert(input, {bottom: option});
                        }
                    }
                }
                input.observe('focus', function(ev) {

                    var fields = document.getElementsByClassName("minigrid-field-" + field);

                    // Disable any options already selected in corresponding select boxes
                    for (var i=0; i < fields.length; i++) {
                        if(fields[i].getAttribute('name') != input.getAttribute('name')) {
                            if (fields[i].selectedIndex != '') {
                                input.options[fields[i].selectedIndex].disabled = true;
                            } else {
                                input.options[fields[i].selectedIndex].disabled = false;
                            }
                        }
                    }
                }.bind(this));
            }
            else {
                input = new Element('input', {style:"width:" + this.rowData[field]['width'],type: this.rowData[field]['type'], name: rowName + "["+rowId+"][" +field + "]"});
                input.addClassName("minigrid-field");
                input.addClassName("minigrid-field-" + field);
            }
            return input;
        },
        addRow : function (row) {
            row = row || this.getNewRow();
            if (typeof this.allRemoved != 'undefined' && this.allRemoved) {
                this.allRemoved.remove();
                delete this.allRemoved;
            }
            Element.insert(this.tbody, {bottom: row});
        },
        removeRow : function (rowId) {
            var row = $(rowId);
            if (typeof row != "undefined" && row) {
                row.remove();
                if (this.tbody.children.length == 0 ) {
                    this.allRemoved = new Element('input', {type:'hidden', name: this.rowName, value:''});
                    Element.insert(this.tbody, {bottom: this.allRemoved});
                }
            }
            return 1;
        }
    }
}
</script>
    <?php
        return $html . ob_get_clean();
    }
}
