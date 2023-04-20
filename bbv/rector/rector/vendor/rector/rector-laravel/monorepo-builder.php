<?php

declare (strict_types=1);
namespace RectorPrefix202206;

use RectorPrefix202206\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use RectorPrefix202206\Symplify\MonorepoBuilder\Release\ReleaseWorker\PushTagReleaseWorker;
use RectorPrefix202206\Symplify\MonorepoBuilder\Release\ReleaseWorker\TagVersionReleaseWorker;
return static function (ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->autowire();
    // @see https://github.com/symplify/monorepo-builder#6-release-flow
    $services->set(TagVersionReleaseWorker::class);
    $services->set(PushTagReleaseWorker::class);
};
