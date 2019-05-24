<?php
/**
 * Copyright © 2017 Linchpin. All rights reserved.
 */

namespace Linchpin\AdvancedSorting\Plugin\Product\ProductList;

/**
 * Class Toolbar
 * @package Linchpin\AdvancedSorting\Plugin\Product\ProductList
 */
class Toolbar
{
	/**
	 * Plugin
	 *
	 * @param \Magento\Catalog\Block\Product\ProductList\Toolbar $subject
	 * @param \Closure $proceed
	 * @param \Magento\Framework\Data\Collection $collection
	 * @return \Magento\Catalog\Block\Product\ProductList\Toolbar
	 */
	public function aroundSetCollection(
		\Magento\Catalog\Block\Product\ProductList\Toolbar $subject,
		\Closure $proceed,
		$collection
	) {
		$currentOrder = $subject->getCurrentOrder();
		$result = $proceed($collection);

		if ($currentOrder) {
			if ($currentOrder == 'price_desc') {
				$subject->getCollection()->setOrder('price', 'desc');
			} elseif ($currentOrder == 'price_asc') {
				$subject->getCollection()->setOrder('price', 'asc');
			}
		}

		return $result;
	}
}
