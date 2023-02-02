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

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Mageplaza\ProductAlerts\Helper\Data;

/**
 * Class GetStatusAlert
 * @package Mageplaza\ProductAlertsGraphQl\Model\Resolver
 */
class GetStatusAlert implements ResolverInterface
{
    /**
     * @var Data
     */
    protected $_helperData;

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * GetStatusAlert constructor.
     *
     * @param Data $helperData
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        Data $helperData,
        ProductRepositoryInterface $productRepository
    ){
        $this->_helperData          = $helperData;
        $this->productRepository    = $productRepository;
    }

    /**
     * @param Field $field
     * @param $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     *
     * @return array
     * @throws LocalizedException
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $storeId = $context->getExtensionAttributes()->getStore()->getId();
        if (!$this->_helperData->isEnabled($storeId)) {
            return [];
        }
        if (!array_key_exists('model', $value) || !$value['model'] instanceof ProductInterface) {
            throw new LocalizedException(__('"model" value should be specified'));
        }
        $product   = $value['model'];
        $product   = $this->productRepository->getById($product->getId());
        return  [
            'mp_productalerts_stock_notify' => $this->_helperData->isProductStockNotifyEnabled($product),
            'mp_productalerts_price_alert'  => $this->_helperData->isProductPriceAlertEnabled($product)
    ];
    }
}
