<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Ruud Walraven 2013
 * @author     Ruud Walraven <ruud.walraven@gmail.com>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */


/**
 * Class ModuleIsotopeProductCategories
 * Front end module Isotope "product categories".
 */
class ModuleIsotopeProductCategories extends ModuleCustomnav
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_navigation';


	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ISOTOPE ECOMMERCE: PRODUCT CATEGORIES ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		// Return if no product has been specified
		if ($this->Input->get('product') == '')
		{
			return '';
		}

		$objProduct = IsotopeFrontend::getProductByAlias($this->Input->get('product'));

		if (!$objProduct)
		{
			return '';
		}

		$this->pages = $objProduct->categories;

		if (!is_array($this->pages) || !strlen($this->pages[0]))
		{
			return '';
		}

		$strBuffer = parent::generate();
		return strlen($this->Template->items) ? $strBuffer : '';
	}
}

