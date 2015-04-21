<?php

namespace Core\Container;

use Core\Domain\DB\DBConnection;
use Core\Domain\Manager\UrlMatchModelManager;
use Core\Domain\Repository\UrlMatchModelRepository;
use Core\Services\ShortenUrlService;
use Pimple\Container;

/**
 * Class ContainerBuilder
 */
class ContainerBuilder
{
    /**
     * @var array
     */
    private $parameters;

    /**
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * load services
     */
    public function init()
    {
        $container = new Container();

        // Load shorten url service
        $container['database_connexion'] = function ($container) {
            return new DBConnection(
                $this->parameters['db-address'],
                $this->parameters['db-user'],
                $this->parameters['db-pwd'],
                $this->parameters['db-name']);
        };

        // Load db manager
        $container['url_match_model_manager'] = function ($container) {
            return new UrlMatchModelManager($container['database_connexion']);
        };

        // Load shorten url service
        $container['url_match_model_repository'] = function ($container) {
            return new UrlMatchModelRepository($container['url_match_model_manager']);
        };

        // Load shorten url service
        $container['shorten_url_service'] = function ($container) {
            return new ShortenUrlService(
                $this->parameters['login-bitly'],
                $this->parameters['pwd-bitly'],
                $container['url_match_model_repository']);
        };

        return $container;
    }
}
