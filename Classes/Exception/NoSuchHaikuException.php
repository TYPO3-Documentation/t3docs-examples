<?php

declare(strict_types=1);

namespace T3docs\Examples\Exception;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

/**
 * Exception thrown if a haiku record was not found
 */
class NoSuchHaikuException extends \RuntimeException
{
}
