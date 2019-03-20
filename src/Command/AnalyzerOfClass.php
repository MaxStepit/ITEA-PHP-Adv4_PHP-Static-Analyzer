<?php

/*
 * This file is part of the "default-project" package.
 *
 * (c) Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Greeflas\StaticAnalyzer\Command;

use Greeflas\StaticAnalyzer\Analyzer\ClassInfo;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AnalyzerOfClass
 * Here going on registration of command.
 */
class AnalyzerOfClass extends Command
{
    protected function configure()
    {
        $this
            ->setName('class-analyze')
            ->setDescription('Shows class type and count of methods and properties according to access modifiers')
            ->addArgument(
                'className',
                InputArgument::REQUIRED,
                'Its may be string'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $className = $input->getArgument('className');
        try {
            $analyzer = new ClassInfo($className);
        } catch (\Exception $e) {
            \printf($e->getMessage());
            die();
        }


        $info = $analyzer->analyze();
        $info['properties']['publicStatic'] ? $info['properties']['publicStatic']= '(' . $info['properties']['publicStatic'] . ' static)' : $info['properties']['publicStatic']= ' ';
        $info['properties']['protectedStatic'] ? $info['properties']['protectedStatic']= '(' . $info['properties']['protectedStatic'] . ' static)' : $info['properties']['protectedStatic']= ' ';
        $info['methods']['publicStatic'] ? $info['methods']['publicStatic']= '(' . $info['methods']['publicStatic'] . ' static)' : $info['methods']['publicStatic']= ' ';
        $info['methods']['privateStatic'] ? $info['methods']['privateStatic']= '(' . $info['methods']['privateStatic'] . ' static)' : $info['methods']['privateStatic']= ' ';



        $output->writeln(\sprintf(
            '<info>
Class:     %s is %s
Properties:
    public: %s      %s
    protected: %s   %s
    private: %s
Methods:
    public: %s     %s
    protected: %s
    private: %s    %s
</info>',
            $info['className'],
            $info['classType'],
            $info['properties']['public'],
            $info['properties']['publicStatic'],
            $info['properties']['protected'],
            $info['properties']['protectedStatic'],
            $info['properties']['private'],
            $info['methods']['public'],
            $info['methods']['publicStatic'],
            $info['methods']['protected'],
            $info['methods']['private'],
            $info['methods']['privateStatic']

        ));
    }
}
