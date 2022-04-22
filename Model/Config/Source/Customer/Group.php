<?php

declare(strict_types=1);

namespace Trellis\CustomerGroupWidget\Model\Config\Source\Customer;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Customer\Model\ResourceModel\Group\CollectionFactory as CustomerGroupCollectionFactory;

class Group implements OptionSourceInterface
{
    protected CustomerGroupCollectionFactory $_customerGroupCollectionFactory;

    /**
     * @param CustomerGroupCollectionFactory $customerGroupCollectionFactory
     */
    public function __construct(
        CustomerGroupCollectionFactory $customerGroupCollectionFactory
    ) {
        $this->_customerGroupCollectionFactory = $customerGroupCollectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        return $this->_customerGroupCollectionFactory->create()->toOptionArray();
    }
}