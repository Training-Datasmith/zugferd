<?php

declare (strict_types=1);
/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace horstoeko\zugferd\quick;

use horstoeko\zugferd\Zugferd_Profiles;
/**
 * Class representing the document descriptor for outgoing documents in EXTENDED profile
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Quick_Descriptor_Extended extends Zugferd_Quick_Descriptor
{
    /**
     * @inheritDoc
     */
    protected static function get_profile(): int
    {
        return Zugferd_Profiles::PROFILE_EXTENDED;
    }
}