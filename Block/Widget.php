<?php

namespace Trellis\CustomerGroupWidget\Block;

use Magento\Cms\Block\Block;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Widget\Block\BlockInterface as WidgetBlockInterface;

class Widget
    extends Block
    implements WidgetBlockInterface
{
    protected $_customerSession;

    public function __construct(
        CustomerSession $customerSession,
        \Magento\Framework\View\Element\Context $context,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Cms\Model\BlockFactory $blockFactory,
        array $data = []
    )
    {
        $this->_customerSession = $customerSession;
        parent::__construct($context, $filterProvider, $storeManager, $blockFactory, $data);
    }

    public function getCacheKeyInfo()
    {
        $info = parent::getCacheKeyInfo();
        $info[] = 'CUSTOMER_GROUP_' . $this->_customerSession->getCustomerGroupId();
        return $info;
    }

    public function toHtml()
    {
        if (!in_array($this->_customerSession->getCustomerGroupId(), $this->getAllowedCustomerGroupIds())) {
            return '';
        }
        return parent::toHtml();
    }

    public function getAllowedCustomerGroupIds()
    {
        return explode(',', $this->getData('allowed_customer_group_ids'));
    }
}