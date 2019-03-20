<?php

/*
 * This file is part of the "default-project" package.
 *
 * (c) Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Greeflas\StaticAnalyzer\Analyzer;

use ReflectionClass;

class MyReflection extends ReflectionClass
{
    public function __construct($argument)
    {
        parent::__construct($argument);
    }

    /**
     * (non-PHPdoc)
     *
     * @see ReflectionClass::getMethods()
     */
    public function getMethods($filter = null, $useAndOperator = true)
    {
        if (true !== $useAndOperator) {
            return parent::getMethods($filter);
        }

        $methods = parent::getMethods($filter);
        $results = [];

        foreach ($methods as $method) {
            if (($method->getModifiers() & $filter) === $filter) {
                $results[] = $method;
            }
        }

        return $results;
    }
    public function getProperties($filter = null, $useAndOperator = true)
    {
        if (true !== $useAndOperator) {
            return parent::getProperties($filter);
        }

        $methods = parent::getProperties($filter);
        $results = [];

        foreach ($methods as $method) {
            if (($method->getModifiers() & $filter) === $filter) {
                $results[] = $method;
            }
        }

        return $results;
    }
}
