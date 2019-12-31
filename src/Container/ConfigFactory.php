<?php

/**
 * @see       https://github.com/laminas/laminas-di for the canonical source repository
 * @copyright https://github.com/laminas/laminas-di/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-di/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\Di\Container;

use Laminas\Di\Config;
use Laminas\Di\ConfigInterface;
use Laminas\Di\LegacyConfig;
use Psr\Container\ContainerInterface;

/**
 * Factory implementation for creating the definition list
 */
class ConfigFactory
{
    /**
     * @param ContainerInterface $container
     * @return Config
     */
    public function create(ContainerInterface $container) : ConfigInterface
    {
        $config = $container->has('config') ? $container->get('config') : [];
        $data = (isset($config['dependencies']['auto'])) ? $config['dependencies']['auto'] : [];

        if (isset($config['di'])) {
            trigger_error(
                'Detected legacy DI configuration, please upgrade to v3. '
                . 'See https://docs.laminas.dev/laminas-di/migration/ for details.',
                E_USER_DEPRECATED
            );

            $legacyConfig = new LegacyConfig($config['di']);
            $data = array_merge_recursive($legacyConfig->toArray(), $data);
        }

        return new Config($data);
    }

    /**
     * Make the instance invokable
     */
    public function __invoke(ContainerInterface $container) : ConfigInterface
    {
        return $this->create($container);
    }
}
