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

use ReflectionMethod;
use ReflectionProperty;

/**
 * @author Maxim Gnatkovsky <Gnatkovsky@bigmir.net>
 * Due to this class you can get to know needed info about the class that interests you.
 */
final class ClassInfo
{
    private $className;
    private $classesAnalyze=[];

    /**
     * ClassInfo constructor.
     * This method takes full className in string format.
     *
     * @param string $className
     *
     */
    public function __construct(string $className)
    {
        if (!\class_exists($className)) {
            throw new \Exception('Class not found.Check the correct of class name.Needed format:"Classname". ');
        }
        $this->className = $className;
    }

    /**
     * This method provide info about class.
     *
     * @throws \ReflectionException
     *
     * @return array
     */
    public function analyze(): array
    {
        $reflection = new MyReflection($this->className);
   
        $this->classesAnalyze['className']= $reflection->getName();

        if ($reflection->isAbstract()) {
            $this->classesAnalyze['classType']='Abstract';
        } elseif ($reflection->isAnonymous()) {
            $this->classesAnalyze['classType']='Anonymous';
        } elseif ($reflection->isFinal()) {
            $this->classesAnalyze['classType']='Final';
        }
        $this->classesAnalyze['properties']['public'] = \count($reflection->getProperties(ReflectionProperty::IS_PUBLIC));
        $this->classesAnalyze['properties']['publicStatic'] = \count($reflection->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_STATIC));
        $this->classesAnalyze['properties']['protected'] = \count($reflection->getProperties(ReflectionProperty::IS_PROTECTED));
        $this->classesAnalyze['properties']['protectedStatic'] = \count($reflection->getProperties(ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_STATIC));
        $this->classesAnalyze['properties']['private'] = \count($reflection->getProperties(ReflectionProperty::IS_PRIVATE));
        $this->classesAnalyze['methods']['public'] = \count($reflection->getMethods(ReflectionMethod::IS_PUBLIC));
        $this->classesAnalyze['methods']['publicStatic'] = \count($reflection->getMethods(ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_STATIC));
        $this->classesAnalyze['methods']['protected'] = \count($reflection->getMethods(ReflectionMethod::IS_PROTECTED));
        $this->classesAnalyze['methods']['private'] = \count($reflection->getMethods(ReflectionMethod::IS_PRIVATE));
        $this->classesAnalyze['methods']['privateStatic'] = \count($reflection->getMethods(ReflectionMethod::IS_PRIVATE | ReflectionMethod::IS_STATIC));

        return $this->classesAnalyze;
    }
}
