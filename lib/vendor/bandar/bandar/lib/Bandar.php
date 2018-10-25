<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Main template engine file
 *
 * PHP version 5
 *
 * LICENSE: Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
 * of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 * IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @category  Templates
 * @package   Bandar
 * @author    Yani Iliev <yani@iliev.me>
 * @copyright 2013 Yani Iliev
 * @license   https://raw.github.com/yani-/bandar/master/LICENSE The MIT License (MIT)
 * @version   GIT: 3.0.0
 * @link      https://github.com/yani-/bandar/
 */

/**
 * Define EOL for CLI and Web
 */
if (!defined('BANDAR_EOL')) {
	define('BANDAR_EOL', php_sapi_name() === 'cli' ? PHP_EOL : '<br />');
}

/**
 * Include exceptions
 */
require_once
	dirname(__FILE__) .
	DIRECTORY_SEPARATOR .
	'Exceptions' .
	DIRECTORY_SEPARATOR .
	'TemplateDoesNotExistException.php';

/**
 * Bandar Main class
 *
 * @category  Templates
 * @package   Bandar
 * @author    Yani Iliev <yani@iliev.me>
 * @copyright 2013 Yani Iliev
 * @license   https://raw.github.com/yani-/bandar/master/LICENSE The MIT License (MIT)
 * @version   Release: 2.0.1
 * @link      https://github.com/yani-/bandar/
 */
class Bandar
{
	/**
	 * Path to template files
	 *
	 * @var string|null
	 */
	public static $templatesPath = null;

	/**
	 * Template file to output
	 * @var string|null
	 */
	public static $template = null;

	/**
	 * Outputs the passed string if Bandar is in debug mode
	 *
	 * @param string $str Debug string to output
	 *
	 * @return void
	 */
	public static function debug($str)
	{
		/**
		 * if debug flag is on, output the string
		 */
		if (defined('BANDAR_DEBUG') && BANDAR_DEBUG) {
			echo $str;
		}
	}

	/**
	 * Retrieves templatesPath from BANDAR_TEMPLATES_PATH constant
	 *
	 * @throws TemplatesPathNotSetException If BANDAR_TEMPLATES_PATH is not defined
	 *
	 * @return string|null Templates path
	 */
	public static function getTemplatesPathFromConstant()
	{
		self::debug(
			'Calling getTemplatesPathFromConstant' . BANDAR_EOL
		);
		if (defined('BANDAR_TEMPLATES_PATH')) {
			return realpath(BANDAR_TEMPLATES_PATH) . DIRECTORY_SEPARATOR;
		}
		return null;
	}

	/**
	 * Setter for template
	 *
	 * @param string $template Template file
	 *
	 * @throws TemplateDoesNotExistException If template file is not found
	 *
	 * @return null
	 */
	public static function setTemplate($template, $path = false)
	{
		self::debug(
			'Calling setTemplate with' . BANDAR_EOL .
			'$template = ' . $template . BANDAR_EOL .
			'type of $template is ' . gettype($template) . BANDAR_EOL
		);

		if ($path) {
			$template = realpath($path) . DIRECTORY_SEPARATOR . $template;
		} else {
			$template = self::getTemplatesPathFromConstant() . $template;
		}

		$template = realpath($template . '.php');
		/**
		 * Check if passed template exist
		 */
		if (self::templateExists($template)) {
			self::$template = $template;
		} else {
			throw new TemplateDoesNotExistException;
		}
	}

	/**
	 * Checks if template exists by using file_exists
	 *
	 * @param string $template Template file
	 *
	 * @return boolean
	 */
	public static function templateExists($template)
	{
		self::debug(
			'Calling templateExists with ' . BANDAR_EOL .
			'$template = ' . $template . BANDAR_EOL .
			'type of $template is ' . gettype($template) . BANDAR_EOL
		);
		return (!is_dir($template) && is_readable($template));
	}

	/**
	 * Renders a passed template
	 *
	 * @param string $template Template name
	 * @param array  $args     Variables to pass to the template file
	 *
	 * @return string Contents of the template
	 */
	public static function render($template, $args=array(), $path = false)
	{
		self::debug(
			'Calling render with' .
			'$template = ' . $template . BANDAR_EOL .
			'type of $template is ' . gettype($template) . BANDAR_EOL .
			'$args = ' . print_r($args, true) . BANDAR_EOL .
			'type of $args is ' . gettype($args) . BANDAR_EOL
		);
		self::setTemplate($template, $path);
		/**
		 * Extracting passed aguments
		 */
		extract($args);
		ob_start();
		/**
		 * Including the view
		 */
		include self::$template;

		return ob_get_flush();
	}

	/**
	 * Returns the content of a passed template
	 *
	 * @param string $template Template name
	 * @param array  $args     Variables to pass to the template file
	 *
	 * @return string Contents of the template
	 */
	public static function getTemplateContent($template, $args=array(), $path = false)
	{
		self::debug(
			'Calling render with' .
			'$template = ' . $template . BANDAR_EOL .
			'type of $template is ' . gettype($template) . BANDAR_EOL .
			'$args = ' . print_r($args, true) . BANDAR_EOL .
			'type of $args is ' . gettype($args) . BANDAR_EOL
		);
		self::setTemplate($template, $path);
		/**
		 * Extracting passed aguments
		 */
		extract($args);
		ob_start();
		/**
		 * Including the view
		 */
		include self::$template;

		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}
}
