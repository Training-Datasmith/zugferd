<?php

declare (strict_types=1);
/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace horstoeko\zugferd;

use Composer\Installed_Versions as ComposerInstalledVersions;
use OutOfBoundsException;
/**
 * Class representing some tools for getting the package version
 * of this package
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
final class Zugferd_Package_Version
{
    /**
     * Get the installed version of this library
     */
    public static function get_installed_version(): string
    {
        try {
            return Composer_Installed_Versions::get_version('horstoeko/zugferd') ?? self::get_default_version();
        } catch (OutOfBoundsException $out_of_bounds_exception) {
            return self::get_default_version();
        }
    }
    /**
     * Return the default version used for this package, when no installation was found
     */
    private static function get_default_version(): string
    {
        return '1.0.x';
    }
}