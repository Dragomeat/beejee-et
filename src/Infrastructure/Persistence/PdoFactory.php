<?php

declare(strict_types=1);

namespace BeeJeeET\Infrastructure\Persistence;

use PDO;
use Psr\Container\ContainerInterface;

class PdoFactory
{
    public function __invoke(ContainerInterface $container): PDO
    {
        $config = $container->get('config')['pdo'];

        $pdo = new PDO(
            sprintf('mysql:host=%s;dbname=%s', $config['host'], $config['db']),
            $config['user'],
            $config['password']
        );

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
}
