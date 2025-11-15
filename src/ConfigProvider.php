<?php

declare(strict_types=1);

namespace Webware\Feature;

final class ConfigProvider
{
    /**
     * Returns the configuration array.
     *
     * @return array<string, mixed>
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    /**
     * Returns the dependencies configuration.
     *
     * @return array<string, array<class-string, class-string>>
     */
    public function getDependencies(): array
    {
        return [
            'aliases' => [
            ],
            'factories' => [
            ],
        ];
    }
}
