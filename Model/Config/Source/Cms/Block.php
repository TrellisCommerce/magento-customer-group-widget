<?php

namespace Trellis\CustomerGroupWidget\Model\Config\Source\Cms;

use Magento\Framework\Option\ArrayInterface;
use Magento\Cms\Model\ResourceModel\Block\Collection as CmsBlockCollection;
use Magento\Cms\Model\ResourceModel\Block\CollectionFactory as CmsBlockCollectionFactory;

class Block
    implements ArrayInterface
{
    protected $_cmsBlockCollectionFactory;

    public function __construct(
        CmsBlockCollectionFactory $cmsBlockCollectionFactory
    )
    {
        $this->_cmsBlockCollectionFactory = $cmsBlockCollectionFactory;
    }

    public function toOptionArray()
    {
        /** @var CmsBlockCollection $blocks */
        $blocks = $this->_cmsBlockCollectionFactory->create();
        return $blocks->toOptionArray();
    }
}