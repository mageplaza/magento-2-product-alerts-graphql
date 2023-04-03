<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_ProductAlertsGraphQl
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

declare(strict_types=1);

namespace Mageplaza\ProductAlertsGraphQl\Model\Resolver;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Mageplaza\ProductAlerts\Api\ProductAlertsRepositoryInterface;
use Mageplaza\ProductAlerts\Model\Config\Source\Type;
use Mageplaza\ProductAlertsGraphQl\Helper\Data;

/**
 * Class Subscriber
 * @package Mageplaza\ProductAlertsGraphQl\Model\Resolver
 */
class Subscriber implements ResolverInterface
{

    /**
     * @var Data
     */
    protected $_helperData;

    /**
     * @var int
     */
    protected $_type;

    /**
     * @var int
     */
    protected $subscriberType;
    /**
     * @var ProductAlertsRepositoryInterface
     */
    private $productAlertsRepository;

    /**
     * Categories constructor.
     *
     * @param Data $helperData
     * @param ProductAlertsRepositoryInterface $productAlertsRepository
     */
    public function __construct(
        Data $helperData,
        ProductAlertsRepositoryInterface $productAlertsRepository
    ) {
        $this->_helperData = $helperData;
        $this->productAlertsRepository = $productAlertsRepository;
    }

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (!$this->_helperData->isEnabled()) {
            return [];
        }

        if (!isset($value['model'])) {
            throw new LocalizedException(__('"model" value should be specified'));
        }

        $customer = $value['model'];

        $searchCriteria = $this->_helperData->validateAndAddFilter($args, 'subscribers');
        if ($this->_type === Type::STOCK_SUBSCRIPTION) {
            try {
                $searchResult = $this->productAlertsRepository->getOutOfStockAlert($customer->getId(), $searchCriteria);
            } catch (NoSuchEntityException $e) {
                return [];
            }

        } else {
            try {
                $searchResult = $this->productAlertsRepository->getPriceAlert($customer->getId(), $searchCriteria);
            } catch (NoSuchEntityException $e) {
                return [];
            }
        }
        $items = $searchResult->getItems();
        $pageInfo = $this->_helperData->getPageInfo($searchResult, $searchCriteria, $args);

        return [
            'total_count' => $searchResult->getTotalCount(),
            'items'       => $items,
            'pageInfo'    => $pageInfo
        ];
    }
}
