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

namespace Mageplaza\ProductAlertsGraphQl\Model\Resolver\Guest;

use Mageplaza\ProductAlerts\Model\Config\Source\Type;
use Mageplaza\ProductAlertsGraphQl\Model\Resolver\GuestSubmitAlert;

/**
 * Class Price
 * @package Mageplaza\ProductAlertsGraphQl\Model\Resolver
 */
class Price extends GuestSubmitAlert
{
    /**
     * @var int
     */
    protected $_type = Type::PRICE_SUBSCRIPTION;
}
