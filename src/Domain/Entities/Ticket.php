<?php


declare(strict_types=1);

namespace Resolution07\Support\Domain\Entities;


use DateTimeImmutable;
use Resolution07\Support\Domain\ValueObjects\Ticket\Description;
use Resolution07\Support\Domain\ValueObjects\Ticket\Status\AbstractStatus;
use Resolution07\Support\Domain\ValueObjects\Ticket\Title;
use Resolution07\Support\Domain\ValueObjects\UID;

final class Ticket
{
    private UID $uid;
    private Title $title;
    private Description $description;
    private AbstractStatus $status;

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

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;

    public function __construct(UID $uid, Title $title, Description $description, AbstractStatus $status)
    {
        $this->uid = $uid;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }
}

