<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2017-2018
 * @package Controller
 * @subpackage Common
 */


namespace Aimeos\Controller\Common\Order\Export\Csv\Processor;


/**
 * Abstract class with common methods for all order CSV export processors
 *
 * @package Controller
 * @subpackage Common
 */
class Base
{
	private $context;
	private $mapping;


	/**
	 * Initializes the object
	 *
	 * @param \Aimeos\MShop\Context\Item\Iface $context Context object
	 * @param array $mapping Associative list of field position in CSV as key and domain item key as value
	 */
	public function __construct( \Aimeos\MShop\Context\Item\Iface $context, array $mapping )
	{
		$this->context = $context;
		$this->mapping = $mapping;
	}


	/**
	 * Returns the context item
	 *
	 * @return \Aimeos\MShop\Context\Item\Iface Context object
	 */
	protected function getContext()
	{
		return $this->context;
	}


	/**
	 * Returns the mapping list
	 *
	 * @return array Associative list of field positions in CSV as keys and domain item keys as values
	 */
	protected function getMapping()
	{
		return $this->mapping;
	}
}
