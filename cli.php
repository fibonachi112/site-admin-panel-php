    <?php
     use Phalcon\Autoload\Loader;
    use Phalcon\Cli\Console;
    use Phalcon\Cli\Dispatcher;
    use Phalcon\Cli\Console\Exception as PhalconException;
    use Phalcon\Di\FactoryDefault\Cli as CliDI;

    $loader = new Loader();
    $loader->setNamespaces(
        [
            'App' => 'app/',
        ]
    );
    $loader->register();

    $container  = new CliDI();
    $dispatcher = new Dispatcher();

    $dispatcher->setDefaultNamespace('App\Tasks');
    $container->setShared('dispatcher', $dispatcher);
    $container->setShared('config', function () {
        return include 'app/config/config.php';
    });

    $console = new Console($container);

    $arguments = [];
    foreach ($argv as $k => $arg) {
        if ($k === 1) {
            $arguments['task'] = $arg;
        } elseif ($k === 2) {
            $arguments['action'] = $arg;
        } elseif ($k >= 3) {
            $arguments['params'][] = array_slice($argv, 3);
        }
    }


    try {
        $console->handle($arguments);
    } catch (PhalconException $e) {
        fwrite(STDERR, $e->getMessage() . PHP_EOL);
        exit(1);
    } catch (\Throwable $throwable) {
        fwrite(STDERR, $throwable->getMessage() . PHP_EOL);
        exit(1);
    } catch (\Exception $exception) {
        fwrite(STDERR, $exception->getMessage() . PHP_EOL);
        exit(1);
    }