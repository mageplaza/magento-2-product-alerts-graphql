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

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Mageplaza\ProductAlerts\Api\ProductAlertsRepositoryInterface;
use Mageplaza\ProductAlerts\Model\Config\Source\Type;

/**
 * Class GuestSubmitAlert
 * @package Mageplaza\ProductAlertsGraphQl\Model\Resolver
 */
class GuestSubmitAlert implements ResolverInterface
{

    /**
     * @var int
     */
    protected $_type;

    /**
     * @var ProductAlertsRepositoryInterface
     */
    private $productAlertsRepository;

    /**
     * Categories constructor.
     *
     * @param ProductAlertsRepositoryInterface $productAlertsRepository
     */
    public function __construct(
        ProductAlertsRepositoryInterface $productAlertsRepository
    ) {
        $this->productAlertsRepository = $productAlertsRepository;
    }

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
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
