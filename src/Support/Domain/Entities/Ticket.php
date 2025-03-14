<?php


declare(strict_types=1);

namespace Resolution07\Support\Domain\Entities;

use Resolution07\Support\Domain\ValueObjects\Ticket\CreatedAt;
use Resolution07\Support\Domain\ValueObjects\Ticket\Description;
use Resolution07\Support\Domain\ValueObjects\Ticket\Status\AbstractStatus;
use Resolution07\Support\Domain\ValueObjects\Ticket\Title;
use Resolution07\Support\Domain\ValueObjects\Ticket\UpdatedAt;
use Resolution07\Support\Domain\ValueObjects\UID;

final class Ticket
{
    private UID $uid;
    private Title $title;
    private Description $description;
    private AbstractStatus $status;
    private CreatedAt $createdAt;
    private UpdatedAt $updatedAt;

    public function getUid(): UID
    {
        return $this->uid;
    }

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function getDescription(): Description
    {
        return $this->description;
    }

    public function getStatus(): AbstractStatus
    {
        return $this->status;
    }

    public function getCreatedAt(): CreatedAt
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): UpdatedAt
    {
        return $this->updatedAt;
    }

    public function __construct(
        UID $uid,
        Title $title,
        Description $description,
        AbstractStatus $status,
        CreatedAt $createdAt,
        UpdatedAt $updatedAt
    ) {
        $this->uid = $uid;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
}
