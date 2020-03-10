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
 * @package     Mageplaza_FaqsGraphQl
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

declare(strict_types=1);

namespace Mageplaza\ProductAlertsGraphQl\Model\Resolver\GetSubscriber;

use Mageplaza\ProductAlerts\Model\Config\Source\Type;
use Mageplaza\ProductAlertsGraphQl\Model\Resolver\Subscriber;

/**
 * Class Stock
 * @package Mageplaza\ProductAlertsGraphQl\Model\Resolver
 */
class Stock extends Subscriber
{
    /**
     * @var int
     */
    protected $_type = Type::STOCK_SUBSCRIPTION;
}
