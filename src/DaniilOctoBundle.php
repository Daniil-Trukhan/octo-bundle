<?php

declare(strict_types=1);

namespace Daniil\OctoBundle;

use Daniil\OctoBundle\DependencyInjection\DaniilOctoExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class DaniilOctoBundle
 *
 * @package Daniil\OctoBundle
 */
final class DaniilOctoBundle extends Bundle
{
    /**
     * Overridden to allow for the custom extension alias.
     */
    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new DaniilOctoExtension();
        }
        return $this->extension;
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
