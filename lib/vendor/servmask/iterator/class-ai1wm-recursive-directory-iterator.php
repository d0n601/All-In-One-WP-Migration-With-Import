<?php
/**
 * Copyright (C) 2014-2018 ServMask Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * ███████╗███████╗██████╗ ██╗   ██╗███╗   ███╗ █████╗ ███████╗██╗  ██╗
 * ██╔════╝██╔════╝██╔══██╗██║   ██║████╗ ████║██╔══██╗██╔════╝██║ ██╔╝
 * ███████╗█████╗  ██████╔╝██║   ██║██╔████╔██║███████║███████╗█████╔╝
 * ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██║╚██╔╝██║██╔══██║╚════██║██╔═██╗
 * ███████║███████╗██║  ██║ ╚████╔╝ ██║ ╚═╝ ██║██║  ██║███████║██║  ██╗
 * ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
 */

class Ai1wm_Recursive_Directory_Iterator extends RecursiveDirectoryIterator {

	public function __construct( $path ) {
		parent::__construct( $path );

		// Skip current and parent directory
		$this->skipdots();
	}

	public function rewind() {
		parent::rewind();

		// Skip current and parent directory
		$this->skipdots();
	}

	public function next() {
		parent::next();

		// Skip current and parent directory
		$this->skipdots();
	}

	/**
	 * Returns whether current entry is a directory and not '.' or '..'
	 *
	 * Explicitly set allow links flag, because RecursiveDirectoryIterator::FOLLOW_SYMLINKS
	 * is not supported by <= PHP 5.3.0
	 *
	 * @return bool
	 */
	public function hasChildren( $allow_links = true ) {
		return parent::hasChildren( $allow_links );
	}

	protected function skipdots() {
		while ( $this->isDot() ) {
			parent::next();
		}
	}
}
