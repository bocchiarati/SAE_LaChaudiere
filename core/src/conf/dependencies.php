<?php

use App\application_core\application\auth\AuthnService;
use App\application_core\application\auth\interfaces\AuthnServiceInterface;
use App\application_core\application\useCases\AppService;
use App\application_core\application\useCases\FormBuilder;
use App\application_core\application\useCases\interfaces\AppServiceInterface;
use App\application_core\application\useCases\interfaces\FormBuilderInterface;
use App\webui\providers\CsrfTokenProvider;
use App\webui\providers\interfaces\AuthnProviderInterface;
use App\webui\providers\interfaces\CsrfTokenProviderInterface;
use App\webui\providers\SessionAuthnProvider;

return function ($container) {
    $container->set(FormBuilderInterface::class, \DI\autowire(FormBuilder::class));
    $container->set(CsrfTokenProviderInterface::class, \DI\autowire(CsrfTokenProvider::class));
    $container->set(AuthnProviderInterface::class, \DI\autowire(SessionAuthnProvider::class));
    $container->set(AuthnServiceInterface::class, \DI\autowire(AuthnService::class));
    $container->set(AppServiceInterface::class, \DI\autowire(AppService::class));
};
