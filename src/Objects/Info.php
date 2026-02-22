<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

use StoneHilt\OpenApi\Utilities\Arr;

/**
 * @property string|null $title
 * @property string|null $description
 * @property string|null $termsOfService
 * @property Contact|null $contact
 * @property License|null $license
 * @property string|null $version
 */
class Info extends BaseObject
{
    /**
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * @var string|null
     */
    protected ?string $termsOfService = null;

    /**
     * @var Contact|null
     */
    protected ?Contact $contact = null;

    /**
     * @var License|null
     */
    protected ?License $license = null;

    /**
     * @var string|null
     */
    protected ?string $version = null;

    /**
     * @param string|null $title
     * @return static
     */
    public function title(?string $title): static
    {
        $instance = clone $this;

        $instance->title = $title;

        return $instance;
    }

    /**
     * @param string|null $description
     * @return static
     */
    public function description(?string $description): static
    {
        $instance = clone $this;

        $instance->description = $description;

        return $instance;
    }

    /**
     * @param string|null $termsOfService
     * @return static
     */
    public function termsOfService(?string $termsOfService): static
    {
        $instance = clone $this;

        $instance->termsOfService = $termsOfService;

        return $instance;
    }

    /**
     * @param Contact|null $contact
     * @return static
     */
    public function contact(?Contact $contact): static
    {
        $instance = clone $this;

        $instance->contact = $contact;

        return $instance;
    }

    /**
     * @param License|null $license
     * @return static
     */
    public function license(?License $license): static
    {
        $instance = clone $this;

        $instance->license = $license;

        return $instance;
    }

    /**
     * @param string|null $version
     * @return static
     */
    public function version(?string $version): static
    {
        $instance = clone $this;

        $instance->version = $version;

        return $instance;
    }

    /**
     * @return array
     */
    protected function generate(): array
    {
        return Arr::filter([
            'title' => $this->title,
            'description' => $this->description,
            'termsOfService' => $this->termsOfService,
            'contact' => $this->contact,
            'license' => $this->license,
            'version' => $this->version,
        ]);
    }
}
