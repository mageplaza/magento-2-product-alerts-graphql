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

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\CustomerGraphQl\Model\Customer\GetCustomer;
use Magento\Framework\GraphQl\Exception\GraphQlAuthenticationException;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Mageplaza\ProductAlerts\Api\ProductAlertsRepositoryInterface;
use Mageplaza\ProductAlerts\Helper\Data;

/**
 * Class Customer
 * @package Mageplaza\ProductAlertsGraphQl\Model\Resolver
 */
class Customer
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
    protected $productAlertsRepository;

    /**
     * @var GetCustomer
     */
    private $getCustomer;

    /**
     * Categories constructor.
     *
     * @param Data $helperData
     * @param GetCustomer $getCustomer
     * @param ProductAlertsRepositoryInterface $productAlertsRepository
     */
    public function __construct(
        Data $helperData,
        GetCustomer $getCustomer,
        ProductAlertsRepositoryInterface $productAlertsRepository
    ) {
        $this->_helperData             = $helperData;
        $this->productAlertsRepository = $productAlertsRepository;
        $this->getCustomer             = $getCustomer;
    }

    /**
     * @param $context
     *
     * @return CustomerInterface
     * @throws GraphQlAuthorizationException
     * @throws GraphQlInputException
     * @throws GraphQlAuthenticationException
     * @throws GraphQlNoSuchEntityException
     */
    public function checkCustomer($context)
    {
        if ($this->_helperData->versionCompare('2.3.3')) {
            if ($context->getExtensionAttributes()->getIsCustomer() === false) {
                throw new GraphQlAuthorizationException(__('The current customer isn\'t authorized.'));
            }

            if (empty($args['input']) || !is_array($args['input'])) {
                throw new GraphQlInputException(__('"input" value should be specified'));
            }
        }

        return $this->getCustomer->execute($context);
    }
}
