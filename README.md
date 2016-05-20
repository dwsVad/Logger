# TimFramework Logger

## Basic usage:
### Initialise:
```php
$logsDir='/path/to/your/logsDir';
\TF\Logger\Logger::addHandler(
    new \TF\Logger\Handlers\FileLogHandler(
        new \TF\Logger\Formatters\DefaultFileLogFormatter(),
        $logsDir
    )
);
```

### Usage samples:
Simple 1:
```php
 \TF\Logger\Logger::getLogger('moduleName1')->log("message",Logger::WARNING);
 ```
Simple 2:
```php
 \TF\Logger\Logger::getLogger('moduleName2')->warning('log message');
 ```
Simple 3:
```php
$loggerModule3 = \TF\Logger\Logger::getLogger('moduleName3');
$loggerModule3->log('log message',Logger::WARNING);
 ```
Simple 4:
```php
$loggerModule4 = Logger::getLogger('moduleName4');
$loggerModule4->warning('log message');
```
