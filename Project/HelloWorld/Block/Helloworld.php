<?php
namespace Project\HelloWorld\Block;

use Magento\Framework\View\Element\Template;
use Project\HelloWorld\Model\NewsFactory;
use Project\HelloWorld\Helper\Data;

class Helloworld extends Template
{


	/**
     * @var \Tutorial\SimpleNews\Model\NewsFactory
     */
    protected $_newsFactory;
    protected $_helloWorldHelper;
    /**
     * @param Template\Context $context
     * @param NewsFactory $newsFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        NewsFactory $newsFactory,
    Data $_helloWorldHelper,
        array $data = []
    ) {
        $this->_helloWorldHelper = $_helloWorldHelper;
        $this->_newsFactory = $newsFactory;

        parent::__construct($context, $data);
    }

    /**
     * Set news collection
     */
    protected  function _construct()
    {
        parent::_construct();
        $collection = $this->_newsFactory->create()->getCollection()
            ->setOrder('id', 'DESC');
        $this->setCollection($collection);
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $test = $this->_helloWorldHelper->getPagination();
        /** @var \Magento\Theme\Block\Html\Pager */
        $pager = $this->getLayout()->createBlock(
            'Magento\Theme\Block\Html\Pager',
            'simplenews.news.list.pager'
        );
//        $pager->setLimit($test)
//            ->setShowAmounts(false)
//            ->setCollection($this->getCollection());
        $pager->setAvailableLimit(array($test=>$test,5=>5,10=>10,20=>20));
        $pager->setShowPerPage(true)->setCollection(
            $this->getCollection());
        $this->setChild('pager', $pager);
//        var_dump(count($pager->setAvailableLimit(array($test=>$test,5=>5,10=>10,20=>20))));exit;
        $this->getCollection()->load();

        return $this;
    }

    /**
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}