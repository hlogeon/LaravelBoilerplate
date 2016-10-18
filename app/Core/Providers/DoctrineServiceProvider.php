<?php

namespace App\Core\Providers;

use Doctrine\MongoDB\Connection;
use Illuminate\Support\ServiceProvider;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\EventManager;
use Doctrine\ODM\MongoDB\Types\Type;
use Gedmo\Tree\TreeListener;
use Gedmo\Timestampable\TimestampableListener;
use Gedmo\Sluggable\SluggableListener;
use Gedmo\Loggable\LoggableListener;
use Gedmo\Sortable\SortableListener;
use Gedmo\Translatable\TranslatableListener;

/**
 * TODO: Configure Doctrine ODM here.
 */
class DoctrineServiceProvider extends ServiceProvider
{
    private $subscribers = [
        TreeListener::class,
        TimestampableListener::class,
        SluggableListener::class,
        LoggableListener::class,
        SortableListener::class,
        TranslatableListener::class,
    ];

    private $entityPaths = [

    ];

    /**
     * Bootstrap.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerDoctrine();
    }

    /**
     * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
     */
    public function registerDoctrine()
    {
        $connection = new Connection();
        $config = new Configuration();
        $config->setProxyDir(app_path('Core/DoctrineProxies'));
        $config->setHydratorDir(app_path('Core/DoctrineHydrators'));
        $config->setProxyNamespace('App\Core\DoctrineProxies');
        $config->setHydratorNamespace('App\Core\DoctrineHydrators');

        $config->setDefaultDB(config('database.connections.mongodb.database'));
        $config->setMetadataDriverImpl(AnnotationDriver::create(config('app.entityPaths')));
        AnnotationDriver::registerAnnotationClasses();
        $evm = $this->getDoctrineEventManager();
        $this->app->bind('Doctrine\ODM\MongoDB\DocumentManager', function ($app) use ($connection, $config, $evm) {
            return DocumentManager::create($connection, $config, $evm);
        });
        Type::overrideType('collection', 'App\Core\Doctrine\Types\Collection');
    }

    /**
     * Configure doctrine event manager and return an instance.
     * @return EventManager [description]
     */
    private function getDoctrineEventManager() : EventManager
    {
        $evm = new EventManager();
        foreach ($this->subscribers as $subscriber) {
            $evm->addEventSubscriber(new $subscriber);
        }

        return $evm;
    }
}
