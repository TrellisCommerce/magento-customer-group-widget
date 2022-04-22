<?php

declare(strict_types=1);

namespace Trellis\CustomerGroupWidget\Block;

use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Cms\Api\GetBlockByIdentifierInterface;
use Magento\Cms\Block\BlockByIdentifier;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Widget\Block\BlockInterface;
use Magento\Customer\Model\Session as CustomerSession;
use Psr\Log\LoggerInterface;

class Widget extends BlockByIdentifier implements BlockInterface
{
    /**
     * @var CustomerSession
     */
    protected CustomerSession $customerSession;

    /**
     * @var BlockRepositoryInterface
     */
    protected BlockRepositoryInterface $blockRepository;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @param GetBlockByIdentifierInterface $blockByIdentifier
     * @param StoreManagerInterface         $storeManager
     * @param FilterProvider                $filterProvider
     * @param Context                       $context
     * @param CustomerSession               $customerSession
     * @param BlockRepositoryInterface      $blockRepository
     * @param LoggerInterface               $logger
     * @param array                         $data
     */
    public function __construct(
        GetBlockByIdentifierInterface $blockByIdentifier,
        StoreManagerInterface $storeManager,
        FilterProvider $filterProvider,
        Context $context,
        CustomerSession $customerSession,
        BlockRepositoryInterface $blockRepository,
        LoggerInterface $logger,
        array $data = []
    ) {
        parent::__construct($blockByIdentifier, $storeManager, $filterProvider, $context, $data);
        $this->customerSession = $customerSession;
        $this->blockRepository = $blockRepository;
        $this->logger = $logger;
    }

    /**
     * @return array
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getCacheKeyInfo(): array
    {
        $info = parent::getCacheKeyInfo();
        $info[] = 'CUSTOMER_GROUP_' . $this->customerSession->getCustomerGroupId();

        return $info;
    }

    /**
     * @return string
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function toHtml(): string
    {
        if (!in_array($this->customerSession->getCustomerGroupId(), $this->getAllowedCustomerGroupIds())) {
            // Don't continue if customer is not in the correct group.
            return '';
        }

        try {
            // Find the correct CMS Block "Identifier". ID is not sufficient.
            $cmsBlock = $this->blockRepository->getById($this->getData('block_id'));
            $this->setData('identifier', $cmsBlock->getIdentifier());

            return parent::toHtml();
        } catch (\Exception $e) {
            // Error finding correct block. Allow rendering of the page to avoid usability issues.
            $this->logger->error("Error trying to load CMS block for customer group widget. ", [$e->getMessage()]);

            return '';
        }
    }

    /**
     * @return false|string[]
     */
    public function getAllowedCustomerGroupIds()
    {
        return explode(',', $this->getData('allowed_customer_group_ids'));
    }
}