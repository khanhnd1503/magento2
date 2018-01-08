<?php
/**
 * Project_HelloWorld extension
 *                     NOTICE OF LICENSE
 * 
 *                     This source file is subject to the Project License
 *                     that is bundled with this package in the file LICENSE.txt.
 *                     It is also available through the world-wide-web at this URL:
 *                     https://www.project.com/LICENSE.txt
 * 
 *                     @category  Project
 *                     @package   Project_HelloWorld
 *                     @copyright Copyright (c) 2016
 *                     @license   https://www.project.com/LICENSE.txt
 */
namespace Project\HelloWorld\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * ID Field Name
     * 
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Event prefix
     * 
     * @var string
     */
    protected $_eventPrefix = 'project_helloworld_post_collection';

    /**
     * Event object
     * 
     * @var string
     */
    protected $_eventObject = 'post_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Project\HelloWorld\Model\Post', 'Project\HelloWorld\Model\ResourceModel\Post');
    }

    /**
     * Get SQL for get record count.
     * Extra GROUP BY strip added.
     *
     * @return \Magento\Framework\DB\Select
     */
    public function getSelectCountSql()
    {
        $countSelect = parent::getSelectCountSql();
        $countSelect->reset(\Zend_Db_Select::GROUP);
        return $countSelect;
    }
    /**
     * @param string $valueField
     * @param string $labelField
     * @param array $additional
     * @return array
     */
    protected function _toOptionArray($valueField = 'id', $labelField = 'title', $additional = [])
    {
        return parent::_toOptionArray($valueField, $labelField, $additional);
    }









//    public function getCategory()
//    {
//        //get values of current page. If not the param value then it will set to 1
//        $page=($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 1;
//        //get values of current limit. If not the param value then it will set to 1
//        $pageSize=($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : 1;
//        $categorycollection = $this->categorycollectionFactory->create();
//        $categorycollection->setPageSize($pageSize);
//        $categorycollection->setCurPage($page);
//        return $categorycollection;
//    }
//
//    protected function _prepareLayout()
//    {
//        parent::_prepareLayout();
//        $this->pageConfig->getTitle()->set(__('Categories'));
//        if ($this->getNews()) {
//            $pager = $this->getLayout()->createBlock(
//                'Project\HelloWorld\Block',
//                'magecomp.category.pager'
//            )->setAvailableLimit(array(5=>5,10=>10,15=>15))->setShowPerPage(true)->setCollection(
//                $this->getCategory()
//            );
//            $this->setChild('pager', $pager);
//            $this->getCategory()->load();
//        }
//        return $this;
//    }
}
