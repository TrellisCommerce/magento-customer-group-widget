<?php

declare(strict_types=1);

namespace Trellis\CustomerGroupWidget\Model\Config\Source\Cms;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Cms\Model\ResourceModel\Block\CollectionFactory as CmsBlockCollectionFactory;

class Block implements OptionSourceInterface
{
    /** @var CmsBlockCollectionFactory */
    protected CmsBlockCollectionFactory $cmsBlockCollectionFactory;

    /**
     * @param CmsBlockCollectionFactory $cmsBlockCollectionFactory
     */
    public function __construct(
        CmsBlockCollectionFactory $cmsBlockCollectionFactory
    ) {
        $this->cmsBlockCollectionFactory = $cmsBlockCollectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        return $this->cmsBlockCollectionFactory->create()->toOptionArray();
    }
}