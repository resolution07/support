<?php

declare(strict_types=1);

namespace Resolution07\Shared\Domain\Criteria;

use Resolution07\Shared\Domain\Collection;

final class Filters extends Collection
{
    public static function fromValues(array $values): self
    {
        return new self(array_map(self::filterBuilder(), $values));
    }

    private static function filterBuilder(): callable
    {
        return fn (array $values): Filter => Filter::fromValues($values);
    }

    public function add(Filter $filter): self
    {
        return new self(array_merge($this->items(), [$filter]));
    }

    public function filters(): array
    {
        return $this->items();
    }

    public function serialize(): string
    {
        return array_reduce(
            $this->items(),
            static fn (string $accumulate, Filter $filter): string => sprintf(
                '%s^%s',
                $accumulate,
                $filter->serialize()
            ),
            ''
        );
    }

    protected function type(): string
    {
        return Filter::class;
    }
}
