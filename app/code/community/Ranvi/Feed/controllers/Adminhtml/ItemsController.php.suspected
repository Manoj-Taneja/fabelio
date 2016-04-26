<?php

class Ranvi_Feed_Adminhtml_ItemsController extends Mage_Adminhtml_Controller_Action
{

    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('ranvi_feed')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Feed Manager'), Mage::helper('adminhtml')->__('Feed Manager'));

        return $this;
    }

    public function indexAction()
    {
        $this->_initAction();
        $prefix = Mage::getConfig()->getTablePrefix();
        $table = $prefix . "ranvi_feed";

        $istableExist = Mage::getSingleton('core/resource')->getConnection('backup_write')->showTableStatus($table);
        $write = Mage::getSingleton('core/resource')->getConnection('core_write');
        if (!is_array($istableExist)) {
            $write->query("CREATE TABLE " . $prefix . "ranvi_feed(
			  id smallint(6) NOT NULL auto_increment,
			  vartimestamp varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Ranvi Feed' AUTO_INCREMENT=1;");

            $write->query("INSERT INTO " . $prefix . "ranvi_feed(id,vartimestamp) values(1,'321')");
        }
        $this->renderLayout();

    }

    /*	public function writeTempData(){
            if($feed_id = $this->getRequest()->getParam('id')){

                $feed = Mage::getModel('ranvi_feed/item')->load($feed_id);
                $start = intval($this->getRequest()->getParam('start'));
                $length = intval($this->getRequest()->getParam('length'));
                $feed->writeTempFile($start, $length);
            }

        }*/

    public function saveAction()
    {

        if ($data = $this->getRequest()->getPost()) {

            try {
                $id = $this->getRequest()->getParam('id');

                $model = Mage::getModel('ranvi_feed/item');


                if (isset($data['field'])) {
                    $content_data = array();
                    $content_data_sorted = array();

                    foreach ($data['field'] as $field) {
                        if (intval($field['order']) && !isset($content_data_sorted[$field['order']])) {

                            $content_data_sorted[intval($field['order'])] = $field;

                        } else {

                            $field['order'] = 0;
                            $content_data[] = $field;
                        }

                    }

                    ksort($content_data_sorted);

                    $data['content'] = json_encode(array_merge($content_data, $content_data_sorted));

                }

                /*if(isset($data['filter']) && is_array($data['filter'])){

                    $data['filter'] = json_encode(array_merge($data['filter'], array()));

                }else{
                    $data['filter'] = json_encode(array());
                }*/

                if (isset($data['upload_day']) && is_array($data['upload_day'])) {

                    $data['upload_day'] = implode(',', $data['upload_day']);

                }

                /*	if (isset($data['upload_interval']) && in_array($data['upload_interval'], array(12,24))){
                        $data['upload_hour_to'] = null;
                    }
                    */
                $model->setData($data)->setId($id)->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('core')->__('Data successfully saved'));

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }

            } catch (Mage_Core_Exception $e) {

                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());

                Mage::getSingleton('core/session')->setFeedData($data);

                if ($model->getId() > 0) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                } else {
                    $this->_redirect('*/*/new', array('type' => $model->getType()));
                }
                return false;

            } catch (Exception $e) {

                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('core')->__('Can’t save data'));

                Mage::getSingleton('core/session')->setFeedData($data);

                if ($model->getId() > 0) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                } else {
                    $this->_redirect('*/*/new', array('type' => $model->getType()));
                }
                return false;

            }
            $this->_redirect('*/*/');
        }
    }

    public function deleteAction()
    {

        if ($id = intval($this->getRequest()->getParam('id'))) {

            $this->_deleteItems(array($id));

        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {

        if ($ids = $this->getRequest()->getParam('id')) {
            if (is_array($ids) && !empty($ids)) {
                $this->_deleteItems($ids);
            }

        }

        $this->_redirect('*/*/');

    }


    protected function _deleteItems($ids)
    {
        if (is_array($ids) && !empty($ids)) {
            foreach ($ids as $id) {

                $item = Mage::getModel('ranvi_feed/item')->load($id);
                $item->delete();

            }
        }
    }

    public function newAction()
    {
        $this->_initAction();

        if ($data = Mage::getSingleton('core/session')->getFeedData()) {
            Mage::register('ranvi_feed', Mage::getModel('ranvi_feed/item')->addData($data));
            Mage::getSingleton('core/session')->setFeedData(null);
        }

        $this->_addContent($this->getLayout()->createBlock('ranvi_feed/adminhtml_items_edit'))
            ->_addLeft($this->getLayout()->createBlock('ranvi_feed/adminhtml_items_edit_tabs'));

        $this->renderLayout();

    }

    public function editAction()
    {

        $this->_initAction();

        if ($id = $this->getRequest()->getParam('id')) {
            Mage::register('ranvi_feed', Mage::getModel('ranvi_feed/item')->load($id));
        }

        $this->_addContent($this->getLayout()->createBlock('ranvi_feed/adminhtml_items_edit'))
            ->_addLeft($this->getLayout()->createBlock('ranvi_feed/adminhtml_items_edit_tabs'));

        $this->renderLayout();

    }

    public function uploadAction()
    {

        if ($id = $this->getRequest()->getParam('id')) {

            $item = Mage::getModel('ranvi_feed/item')->load($id);

            try {

                if ($item->ftpUpload()) {

                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('core')->__('File "%s" was uploaded!', $item->getFilename()));

                }

            } catch (Mage_Core_Exception $e) {

                Mage::getSingleton('adminhtml/session')->addError($item->getFilename() . ' - ' . $e->getMessage());

            } catch (Exception $e) {

                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('core')->__('%s - Can\'t upload. Please, check your FTP Settings or Hosting Settings', $item->getFilename()));

            }

            return $this->_redirect('*/*/edit', array('id' => $id));

        }

        $this->_redirect('*/*/index');

    }

    public function generateAction()
    {

        if ($id = $this->getRequest()->getParam('id')) {

            try {

                $feed = Mage::getModel('ranvi_feed/item')->load($id);
                Mage::app()->setCurrentStore($feed->getStoreId());
                $feed->setRestartCron(1);
                $feed->save();
                //  $feed->generateFeed();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('core')->__('Your feed will be generated in a few minutes. *Note: Feeds will ONLY generate if a cronjob was set to generate the feed. Please read installation instructions.'));

            } catch (Mage_Core_Exception $e) {

                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());

            } catch (Exception $e) {

                if (!ini_get('allow_url_fopen')) {
                    Mage::getSingleton('adminhtml/session')->addError(Mage::helper('core')->__('Check the "allow_url_fopen" option.
                            Check that the "allow_url_fopen" option it enabled.
                            This option enables the URL-aware fopen wrappers that enable accessing URL object like files.
                            Learn more at <a target="_blank" href="http://php.net/manual/en/filesystem.configuration.php">http://php.net/manual/en/filesystem.configuration.php</a>'));
                } elseif (strpos(strtolower($e->getMessage()), 'permission')) {
                    Mage::getSingleton('adminhtml/session')->addError(Mage::helper('core')->__('Check the Permission for the "Media" directory.
							Check that the "media" directory of your Magento has permission equal to 777 or 0777.'));
                } else {
                    Mage::getSingleton('adminhtml/session')->addError(Mage::helper('core')->__('Can\'t generate feed file'));
                    Mage::getSingleton('adminhtml/session')->addError(Mage::helper('core')->__('If "Time out" error.
							 Please ask your server administrator to increase script run times. Learn more at <a target="_blank" href="http://php.net/manual/en/function.set-time-limit.php">http://php.net/manual/en/function.set-time-limit.php</a>'));
                }


            }

            return $this->_redirect('*/*/edit', array('id' => $id));

        }

        return $this->_redirect('*/*/index');

    }

    public function getattributevaluefieldAction()
    {

        if ($code = $this->getRequest()->getParam('attribute_code')) {

            $name = $this->getRequest()->getParam('element_name');
            $store_id = $this->getRequest()->getParam('store_id');
            $iterator = $this->getRequest()->getParam('iterator');

            if ($code == 'product_type') {
                $condition = Ranvi_Feed_Block_Adminhtml_Items_Edit_Tab_Filter::getConditionSelectLight($iterator);
            } else {
                $condition = Ranvi_Feed_Block_Adminhtml_Items_Edit_Tab_Filter::getConditionSelect($iterator);
            }

            $this->getResponse()->setBody(
                Zend_Json::encode(
                    array(
                        'attributevalue' => Ranvi_Feed_Block_Adminhtml_Items_Edit_Tab_Filter::getAttributeValueField($code, $name, null, $store_id),
                        'condition' => $condition,
                        'iterator' => $iterator
                    )
                )
            );
        }

    }

}