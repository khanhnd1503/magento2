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
namespace Project\HelloWorld\Block\Adminhtml\Post\Edit\Tab;

class Post extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * Wysiwyg config
     * 
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

    /**
     * Country options
     * 
     * @var \Magento\Config\Model\Config\Source\Locale\Country
     */
    protected $_countryOptions;

    /**
     * Country options
     * 
     * @var \Magento\Config\Model\Config\Source\Yesno
     */
    protected $_booleanOptions;

    /**
     * Sample Multiselect options
     * 
     * @var \Project\HelloWorld\Model\Post\Source\SampleMultiselect
     */
    protected $_sampleMultiselectOptions;

    /**
     * constructor
     * 
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Config\Model\Config\Source\Locale\Country $countryOptions
     * @param \Magento\Config\Model\Config\Source\Yesno $booleanOptions
     * @param \Project\HelloWorld\Model\Post\Source\SampleMultiselect $sampleMultiselectOptions
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Magento\Config\Model\Config\Source\Locale\Country $countryOptions,
        \Magento\Config\Model\Config\Source\Yesno $booleanOptions,
        \Project\HelloWorld\Model\Post\Source\SampleMultiselect $sampleMultiselectOptions,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    )
    {
        $this->_wysiwygConfig            = $wysiwygConfig;
        $this->_countryOptions           = $countryOptions;
        $this->_booleanOptions           = $booleanOptions;
        $this->_sampleMultiselectOptions = $sampleMultiselectOptions;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Project\HelloWorld\Model\Post $post */
        $post = $this->_coreRegistry->registry('project_helloworld_post');
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('post_');
        $form->setFieldNameSuffix('post');
        $fieldset = $form->addFieldset(
            'base_fieldset',
            [
                'legend' => __('Post Information'),
                'class'  => 'fieldset-wide'
            ]
        );
        $fieldset->addType('image', 'Project\HelloWorld\Block\Adminhtml\Post\Helper\Image');
        $fieldset->addType('file', 'Project\HelloWorld\Block\Adminhtml\Post\Helper\File');
        if ($post->getId()) {
            $fieldset->addField(
                'id',
                'hidden',
                ['name' => 'id']
            );
        }
        $fieldset->addField(
            'title',
            'text',
            [
                'name'  => 'title',
                'label' => __('Title'),
                'title' => __('Title'),
                'required' => true,
            ]
        );
        $fieldset->addField(
            'description',
            'text',
            [
                'name'  => 'description',
                'label' => __('Description'),
                'title' => __('Description'),
            ]
        );
        $fieldset->addField(
            'status',
            'select',
            [
                'name'  => 'status',
                'label' => __('Status'),
                'title' => __('Status'),
                'values' => $this->_booleanOptions->toOptionArray(),
            ]
        );
        $fieldset->addField(
            'featured_image',
            'image',
            array(
                'name' => 'featured_image',
                'label' => __('Photo'),
                'title' => __('Photo'),
            )
//            [
//                'name'  => 'image',
//                'label' => __('Image'),
//                'title' => __('Image'),
//                'renderer'  => 'Project\HelloWorld\Block\Adminhtml\Quotation\Renderer\LogoImage',
//            ]
        );


        $postData = $this->_session->getData('project_helloworld_post_data', true);
        if ($postData) {
            $post->addData($postData);
        } else {
            if (!$post->getId()) {
                $post->addData($post->getDefaultValues());
            }
        }

        $form->addValues($post->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Post');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->getTabLabel();
    }

    /**
     * Can show tab in tabs
     *
     * @return boolean
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Tab is hidden
     *
     * @return boolean
     */
    public function isHidden()
    {
        return false;
    }

//    protected function _prepareColumns()
//    {
//        $this->addColumn(
//            'id',
//            [
//                'header' => __('ID'),
//                'sortable' => true,
//                'header_css_class' => 'col-id',
//                'column_css_class' => 'col-id',
//                'index' => 'id'
//            ]
//        );

//        $this->addColumn(
//            'title',
//            [
//                'header' => __('Product'),
//                'renderer' => \Magento\Sales\Block\Adminhtml\Order\Create\Search\Grid\Renderer\Product::class,
//                'index' => 'title'
//            ]
//        );
//        $this->addColumn('sku', ['header' => __('SKU'), 'index' => 'sku']);
//        $this->addColumn(
//            'price',
//            [
//                'header' => __('Price'),
//                'column_css_class' => 'price',
//                'type' => 'currency',
//                'currency_code' => $this->getStore()->getCurrentCurrencyCode(),
//                'rate' => $this->getStore()->getBaseCurrency()->getRate($this->getStore()->getCurrentCurrencyCode()),
//                'index' => 'price',
//                'renderer' => \Magento\Sales\Block\Adminhtml\Order\Create\Search\Grid\Renderer\Price::class
//            ]
//        );
//
//        $this->addColumn(
//            'in_products',
//            [
//                'header' => __('Select'),
//                'type' => 'checkbox',
//                'name' => 'in_products',
//                'values' => $this->_getSelectedProducts(),
//                'index' => 'entity_id',
//                'sortable' => false,
//                'header_css_class' => 'col-select',
//                'column_css_class' => 'col-select'
//            ]
//        );
//
//        $this->addColumn(
//            'qty',
//            [
//                'filter' => false,
//                'sortable' => false,
//                'header' => __('Quantity'),
//                'renderer' => \Magento\Sales\Block\Adminhtml\Order\Create\Search\Grid\Renderer\Qty::class,
//                'name' => 'qty',
//                'inline_css' => 'qty',
//                'type' => 'input',
//                'validate_class' => 'validate-number',
//                'index' => 'qty'
//            ]
//        );

//        $p = get_parent_class($this);
//        $pp = get_parent_class($p);
//        return $pp::_prepareColumns();
//    }
}
