# ![Kinedu](https://raw.githubusercontent.com/Kinedu/cfdi-utils/gh-pages/assets/img/logo.png)

[![Travis](https://img.shields.io/travis/Kinedu/cfdi-xslt.svg?style=flat-square)](https://travis-ci.org/Kinedu/cfdi-xslt)
[![StyleCI](https://styleci.io/repos/118779222/shield?branch=master)](https://styleci.io/repos/118779222)
[![Quality Score](https://img.shields.io/scrutinizer/g/Kinedu/cfdi-xslt.svg?style=flat-square)](https://scrutinizer-ci.com/g/Kinedu/cfdi-xslt)
[![Total Downloads](https://poser.pugx.org/kinedu/cfdi-xslt/downloads?format=flat-square)](https://packagist.org/packages/kinedu/cfdi-xslt)
[![License](https://img.shields.io/github/license/kinedu/cfdi-xml.svg?style=flat-square)](https://packagist.org/packages/kinedu/cfdi-xslt)

## Instalación

Instalar el paquete mediante [Composer](https://getcomposer.org/).

```shell
composer require kinedu/cfdi-xslt
```

## Uso

```php
use Kinedu\CfdiXslt\Retrieve;

$myFolder = './xslt/';

$retrieve = new Retrieve();
$retrieve->download($myFolder);
```

## Licencia

CFDI XSLT esta bajo la Licencia MIT, si quieres saber más al respecto puedes ver el archivo de [Licencia](LICENSE) que se encuentra en este mismo repositorio.
