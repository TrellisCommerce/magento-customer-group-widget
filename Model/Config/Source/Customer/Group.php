<?php

namespace Trellis\CustomerGroupWidget\Model\Config\Source\Customer;

use Magento\Framework\Option\ArrayInterface;
use Magento\Customer\Model\ResourceModel\Group\Collection as CustomerGroupCollection;
use Magento\Customer\Model\ResourceModel\Group\CollectionFactory as CustomerGroupCollectionFactory;

class Group
    implements ArrayInterface
{
    protected $_customerGroupCollectionFactory;

    public function __construct(
        CustomerGroupCollectionFactory $customerGroupCollectionFactory
    )
    {
        $this->_customerGroupCollectionFactory = $customerGroupCollectionFactory;
    }

    public function toOptionArray()
    {
        /** @var CustomerGroupCollection $groups */
        $groups = $this->_customerGroupCollectionFactory->create();
        return $groups->toOptionArray();
    }
}