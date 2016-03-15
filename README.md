# TimFramework Logger

## Basic usage:
 ### Initialise:
 *      $logsDir='/path/to/your/logsDir';
        Logger::addHandler(
            new FileLogHandler(
                new DefaultFileLogFormatter(),
                $logsDir
            )
        );

 ### Usage samples:
 1.
 *          Logger::getLogger('moduleName1')->log("message",Logger::WARNING);
 2.
 *          Logger::getLogger('moduleName2')->warning('log message');
 3.
 *          $loggerModule3 = Logger::getLogger('moduleName3');
            $loggerModule3->log('log message',Logger::WARNING);
 4.
 *          $loggerModule4 = Logger::getLogger('moduleName4');
            $loggerModule4->warning('log message');