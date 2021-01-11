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
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Mageplaza\ProductAlerts\Api\ProductAlertsRepositoryInterface;
use Mageplaza\ProductAlerts\Helper\Data as HelperData;

/**
 * Class Configs
 * @package Mageplaza\ProductAlertsGraphQl\Model\Resolver
 */
class Configs implements ResolverInterface
{
    /**
     * @var ProductAlertsRepositoryInterface
     */
    protected $productAlertRepo;

    /**
     * @var HelperData
     */
    protected $helperData;

    /**
     * Configs constructor.
     *
     * @param ProductAlertsRepositoryInterface $productAlertRepo
     * @param HelperData $helperData
     */
    public function __construct(
        ProductAlertsRepositoryInterface $productAlertRepo,
        HelperData $helperData
    ) {
        $this->productAlertRepo = $productAlertRepo;
        $this->helperData       = $helperData;
    }

    /**
     * @inheritDoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (!$this->helperData->isEnabled()) {
            throw new GraphQlNoSuchEntityException(__('Module is disabled.'));
        }

        return $this->productAlertRepo->getConfig();
    }
}
