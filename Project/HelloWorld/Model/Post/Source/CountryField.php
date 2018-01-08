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
namespace Project\HelloWorld\Model\Post\Source;

class CountryField implements \Magento\Framework\Option\ArrayInterface
{
    const _EMPTY = 1;


    /**
     * to option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            [
                'value' => self::_EMPTY,
                'label' => __('')
            ],
        ];
        return $options;

    }
}
