<?php
/**
 * FullNextSearch - Full Text Search your Nextcloud.
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Maxence Lange <maxence@artificial-owl.com>
 * @copyright 2017
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\FullNextSearch\Model;

use OCA\FullNextSearch\Service\MiscService;

class SearchRequest implements \JsonSerializable {

	/** @var string */
	private $search;

	/** @var int */
	private $page = 0;

	/** @var int */
	private $count = 10;


	/**
	 * SearchRequest constructor.
	 */
	public function __construct() {
	}


	/**
	 * @return string
	 */
	public function getSearch() {
		return $this->search;
	}

	/**
	 * @param string $search
	 */
	public function setSearch($search) {
		$this->search = $search;
	}

	public function cleanSearch() {
		$this->search = trim(str_replace('  ', ' ', $this->search));
	}

	/**
	 * @return int
	 */
	public function getPage() {
		return $this->page;
	}

	/**
	 * @param int $page
	 */
	public function setPage($page) {
		$this->page = $page;
	}


	/**
	 * @return int
	 */
	public function getCount() {
		return $this->count;
	}

	/**
	 * @param int $count
	 */
	public function setCount($count) {
		$this->count = $count;
	}


	/**
	 * @return array
	 */
	public function jsonSerialize() {

		return [
			'search' => $this->getSearch(),
			'page'   => $this->getPage(),
			'count'  => $this->getCount()
		];
	}


	/**
	 * @param string $json
	 *
	 * @return SearchRequest
	 */
	public static function fromJSON($json) {
		return self::fromArray(json_decode($json, true));
	}

	/**
	 * @param array $arr
	 *
	 * @return SearchRequest
	 */
	public static function fromArray($arr) {
		$request = new SearchRequest();
		$request->setSearch(MiscService::get($arr, 'search', ''));
		$request->setPage(MiscService::get($arr, 'page', 0));
		$request->setCount(MiscService::get($arr, 'count', 10));


		return $request;
	}


}