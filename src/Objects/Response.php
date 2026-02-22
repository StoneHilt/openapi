<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

use StoneHilt\OpenApi\Utilities\Arr;

/**
 * @property int|null $statusCode
 * @property string|null $description
 * @property Header[]|null $headers
 * @property MediaType[]|null $content
 * @property Link[]|null $links
 */
class Response extends BaseObject
{
    /**
     * @var int|null
     */
    protected ?int $statusCode = null;

    /**
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * @var Header[]|null
     */
    protected ?array $headers = null;

    /**
     * @var MediaType[]|null
     */
    protected ?array $content = null;

    /**
     * @var Link[]|null
     */
    protected ?array $links = null;

    /**
     * @param string|null $objectId
     * @return static
     */
    public static function ok(string $objectId = null): static
    {
        return static::create($objectId)
            ->statusCode(200)
            ->description('OK');
    }

    /**
     * @param string|null $objectId
     * @return static
     */
    public static function created(string $objectId = null): static
    {
        return static::create($objectId)
            ->statusCode(201)
            ->description('Created');
    }

    /**
     * @param string|null $objectId
     * @return static
     */
    public static function movedPermanently(string $objectId = null): static
    {
        return static::create($objectId)
            ->statusCode(301)
            ->description('Moved Permanently');
    }

    /**
     * @param string|null $objectId
     * @return static
     */
    public static function movedTemporarily(string $objectId = null): static
    {
        return static::create($objectId)
            ->statusCode(302)
            ->description('Moved Temporarily');
    }

    /**
     * @param string|null $objectId
     * @return static
     */
    public static function badRequest(string $objectId = null): static
    {
        return static::create($objectId)
            ->statusCode(400)
            ->description('Bad Request');
    }

    /**
     * @param string|null $objectId
     * @return static
     */
    public static function unauthorized(string $objectId = null): static
    {
        return static::create($objectId)
            ->statusCode(401)
            ->description('Unauthorized');
    }

    /**
     * @param string|null $objectId
     * @return static
     */
    public static function forbidden(string $objectId = null): static
    {
        return static::create($objectId)
            ->statusCode(403)
            ->description('Forbidden');
    }

    /**
     * @param string|null $objectId
     * @return static
     */
    public static function notFound(string $objectId = null): static
    {
        return static::create($objectId)
            ->statusCode(404)
            ->description('Not Found');
    }

    /**
     * @param string|null $objectId
     * @return static
     */
    public static function unprocessableEntity(string $objectId = null): static
    {
        return static::create($objectId)
            ->statusCode(422)
            ->description('Unprocessable Entity');
    }

    /**
     * @param string|null $objectId
     * @return static
     */
    public static function tooManyRequests(string $objectId = null): static
    {
        return static::create($objectId)
            ->statusCode(429)
            ->description('Too Many Requests');
    }

    /**
     * @param string|null $objectId
     * @return static
     */
    public static function internalServerError(string $objectId = null): static
    {
        return static::create($objectId)
            ->statusCode(500)
            ->description('Internal Server Error');
    }

    /**
     * @param int|null $statusCode
     * @return static
     */
    public function statusCode(?int $statusCode): static
    {
        $instance = clone $this;

        $instance->statusCode = $statusCode;

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
     * @param Header[] $headers
     * @return static
     */
    public function headers(Header ...$headers): static
    {
        $instance = clone $this;

        $instance->headers = $headers ?: null;

        return $instance;
    }

    /**
     * @param MediaType[] $content
     * @return static
     */
    public function content(MediaType ...$content): static
    {
        $instance = clone $this;

        $instance->content = $content ?: null;

        return $instance;
    }

    /**
     * @param Link[] $links
     * @return static
     */
    public function links(Link ...$links): static
    {
        $instance = clone $this;

        $instance->links = $links ?: null;

        return $instance;
    }

    /**
     * @return array
     */
    protected function generate(): array
    {
        $headers = [];
        foreach ($this->headers ?? [] as $header) {
            $headers[$header->objectId] = $header;
        }

        $content = [];
        foreach ($this->content ?? [] as $contentItem) {
            $content[$contentItem->mediaType] = $contentItem;
        }

        $links = [];
        foreach ($this->links ?? [] as $link) {
            $links[$link->objectId] = $link;
        }

        return Arr::filter([
            'description' => $this->description,
            'headers' => $headers ?: null,
            'content' => $content ?: null,
            'links' => $links ?: null,
        ]);
    }
}
