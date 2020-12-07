<?php


return [
    \Doctrine\ORM\EntityManagerInterface::class => function (\Psr\Container\ContainerInterface $container) {
        $settings = $container->get('config')['doctrine'];

        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
            $settings['metadata_dirs'],
            $settings['dev_mode'],
            $settings['proxy_dir'],
            $settings['cache_dir']
                ?
                new \Doctrine\Common\Cache\FilesystemCache($settings['cache_dir'])
                :
                new \Doctrine\Common\Cache\ArrayCache(),
        );

        $config->setNamingStrategy(new \Doctrine\ORM\Mapping\UnderscoreNamingStrategy());

        return \Doctrine\ORM\EntityManager::create(
            $settings['connection'],
            $config,
        );
    },
    'config' => [
        'doctrine' => [
            'dev_mode' => false,
            'cache_dir' => __DIR__ . '/../../var/cache/doctrine/cache',
            'proxy_dir' => __DIR__ . '/../../var/cache/doctrine/proxy',
            'connection' => [
                'driver' => 'pdo_pgsql',
                'host' => 'api-postgres',
                'user' => getenv('POSTGRES_USER'),
                'password' => getenv('POSTGRES_PASSWORD'),
                'dbname' => getenv('POSTGRES_DB'),
                'charset' => 'utf-8'
            ],
            'metadata_dirs' => []
        ]
    ]

];