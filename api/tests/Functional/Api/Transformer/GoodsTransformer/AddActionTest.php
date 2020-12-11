<?php

declare(strict_types=1);


namespace Test\Functional\Api\Transformer\GoodsTransformer;


use Ramsey\Uuid\Uuid;
use Test\Functional\Fixture\Transformer\GoodsTransformerFixture;
use Test\Functional\Fixture\Transformer\UserTransformerFixture;
use Test\Functional\WebTestCase;

class AddActionTest extends WebTestCase
{
    private string $url = '/goods_transformer/add';

    public function setUp(): void
    {
        parent::setUp();

        $this->loadFixtures(
            [
                GoodsTransformerFixture::class
            ]
        );
    }

    public function testMethod(): void
    {
        $response = $this->app()->handle(self::json('GET', $this->url));

        self::assertEquals(405, $response->getStatusCode());
    }

    public function testSuccess(): void
    {
        $uuid = Uuid::uuid4()->toString();

        $response = $this->app()->handle(self::json('POST', $this->url, ['uuid' => $uuid]));

        self::assertEquals(200, $response->getStatusCode());
    }

    /**
     * @throws \JsonException
     */
    public function testAlreadyExist(): void
    {
        $uuid = GoodsTransformerFixture::UUID_1;

        $response = $this->app()->handle(self::json('POST', $this->url, ['uuid' => $uuid]));
        $data = json_decode($response->getBody()->getContents(), true);

        self::assertEquals(409, $response->getStatusCode());
        self::assertEquals('Goods Transformer with this UUID already exists.', $data['message']);
    }

    public function testUrlNotFound(): void
    {
        $uuid = Uuid::uuid4()->toString();

        $response = $this->app()->handle(self::json('POST', $this->url . '__', ['uuid' => $uuid]));

        self::assertEquals(404, $response->getStatusCode());
    }

    /**
     * @throws \JsonException
     */
    public function testInvalidUud(): void
    {
        $uuid = GoodsTransformerFixture::UUID_1 . '__invalid__';

        $response = $this->app()->handle(self::json('POST', $this->url, ['uuid' => $uuid]));
        $data = json_decode($response->getBody()->getContents(), true);

        self::assertEquals(422, $response->getStatusCode());
        self::assertEquals('This is not a valid UUID.', $data['errors']['uuid']);
    }

    /**
     * @throws \JsonException
     */
    public function testEmpty(): void
    {
        $response = $this->app()->handle(self::json('POST', $this->url, []));
        $data = json_decode($response->getBody()->getContents(), true);

        self::assertEquals(422, $response->getStatusCode());
        self::assertEquals('This value should not be blank.', $data['errors']['uuid']);
    }
}
