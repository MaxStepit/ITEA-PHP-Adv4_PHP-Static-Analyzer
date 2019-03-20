PHP Class Analyzer
===================


Installation
------------

TODO

Usage
-----

`$ ./bin/console class-analyze <className> ` - counts classes/interfaces/trait
created by some developer in project.

$php console class-analyze "Greeflas\StaticAnalyzer\PhpClassInfo"

Class:      ClassInfo is Final
Properties:
    public:    0       
    protected: 0    
    private:   0
Methods:
    public:    1     (1 static)
    protected: 0
    private:   1     

Code style fixer
----------------


To fix the code style just run the following command

```
$ composer cs-fix
```

License
-------

[![license](https://img.shields.io/github/license/greeflas/default-project.svg)](LICENSE)

This project is released under the proprearity (LICENSE).

Copyright (c) 2019, Vladimir Kuprienko
