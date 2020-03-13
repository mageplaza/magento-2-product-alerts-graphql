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

namespace Mageplaza\ProductAlertsGraphQl\Helper;

use Magento\Framework\Api\Search\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\Resolver\Argument\SearchCriteria\Builder as SearchCriteriaBuilder;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\ObjectManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Mageplaza\Core\Helper\AbstractData as CoreHelper;

/**
 * Class Data
 * @package Mageplaza\ProductAlertsGraphQl\Helper
 */
class Data extends CoreHelper
{
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * Data constructor.
     *
     * @param Context $context
     * @param ObjectManagerInterface $objectManager
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        ObjectManagerInterface $objectManager,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        StoreManagerInterface $storeManager
    ) {
        parent::__construct($context, $objectManager, $storeManager);
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @param $args
     * @param $fieldName
     *
     * @return SearchCriteriaInterface
     * @throws GraphQlInputException
     */
    public function validateAndAddFilter($args, $fieldName)
    {
        $this->validateArgsPage($args);
        $searchCriteria = $this->searchCriteriaBuilder->build($fieldName, $args);
        $searchCriteria->setCurrentPage($args['currentPage']);
        $searchCriteria->setPageSize($args['pageSize']);

        return $searchCriteria;
    }

    /**
     * @param SearchResultsInterface|array $searchResult
     * @param SearchCriteriaInterface $searchCriteria
     * @param $args
     *
     * @return array
     * @throws GraphQlInputException
     */
    public function getPageInfo($searchResult, $searchCriteria, $args)
    {
        //possible division by 0
        if ($searchCriteria->getPageSize()) {
            $maxPages = ceil(count($searchResult) / $searchCriteria->getPageSize());
        } else {
            $maxPages = 0;
        }

        $currentPage = $searchCriteria->getCurrentPage();
        if ($searchCriteria->getCurrentPage() > $maxPages && count($searchResult) > 0) {
            throw new GraphQlInputException(
                __(
                    'currentPage value %1 specified is greater than the %2 page(s) available.',
                    [$currentPage, $maxPages]
                )
            );
        }

        return [
            'pageSize'        => $args['pageSize'],
            'currentPage'     => $args['currentPage'],
            'hasNextPage'     => $currentPage < $maxPages,
            'hasPreviousPage' => $currentPage > 1,
            'startPage'       => 1,
            'endPage'         => $maxPages,
        ];
    }

    /**
     * @param SearchResultsInterface $searchResult
     *
     * @return array
     */
    public function getApiSearchResult(SearchResultsInterface $searchResult)
    {
        $items = [];
        /** @var AbstractModel $item */
        foreach ($searchResult->getItems() as $item) {
            $item->setData('model', $item);
            $items[$item->getId()] = $item->getData();
        }

        return $items;
    }

    /**
     * @param array $args
     *
     * @throws GraphQlInputException
     */
    public function validateArgsPage(array $args)
    {
        if (isset($args['currentPage']) && $args['currentPage'] < 1) {
            throw new GraphQlInputException(__('currentPage value must be greater than 0.'));
        }

        if (isset($args['pageSize']) && $args['pageSize'] < 1) {
            throw new GraphQlInputException(__('pageSize value must be greater than 0.'));
        }
    }
}
