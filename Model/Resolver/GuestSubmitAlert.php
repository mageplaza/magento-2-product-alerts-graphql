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
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Mageplaza\ProductAlerts\Api\ProductAlertsRepositoryInterface;
use Mageplaza\ProductAlerts\Model\Config\Source\Type;
use Mageplaza\ProductAlertsGraphQl\Helper\Data;

/**
 * Class GuestSubmitAlert
 * @package Mageplaza\ProductAlertsGraphQl\Model\Resolver
 */
class GuestSubmitAlert implements ResolverInterface
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
        $this->_helperData             = $helperData;
        $this->productAlertsRepository = $productAlertsRepository;
    }

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (empty($args['input']['email'])) {
            throw new GraphQlInputException(__('"email" is not empty.'));
        }
        if (empty($args['input']['productSku'])) {
            throw new GraphQlInputException(__('"productSku" is not empty.'));
        }

        if ($this->_type === Type::STOCK_SUBSCRIPTION) {
            return $this->productAlertsRepository->guestSubscriberStock(
                $args['input']['email'],
                $args['input']['productSku']
            );
        }

        return $this->productAlertsRepository->guestSubscriberPrice(
            $args['input']['email'],
            $args['input']['productSku']
        );
    }
}
