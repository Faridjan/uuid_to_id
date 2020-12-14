<?php

declare(strict_types=1);


namespace Test\Functional\Api\Transformer\GoodsTransformer;


use App\Helper\FormatHelper;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Test\Functional\Fixture\Transformer\GoodsTransformerFixture;
use Test\Functional\WebTestCase;

/**
 * Class GoodsTransformerTest
 * @package Test\Functional\Api\Transformer\GoodsTransformer
 */
class GoodsTransformerTest extends WebTestCase
{
    private string $url = '/id/goods';

    public function setUp(): void
    {
        parent::setUp();

        $this->loadFixtures(
            [
                GoodsTransformerFixture::class
            ]
        );
    }

    /**
     * @throws \JsonException
     */
    public function testMethod(): void
    {
        $response = $this->app()->handle(self::json('POST', $this->url));

        self::assertEquals(405, $response->getStatusCode());
    }

    /**
     * @throws \JsonException
     */
    public function testSuccess(): void
    {
        $uuid = GoodsTransformerFixture::UUID_1;

        $response = $this->app()->handle(self::json('GET', $this->url . '?uuid=' . $uuid));

        $data = json_decode($response->getBody()->getContents(), true);
        $createdAt = DateTimeImmutable::createFromFormat(FormatHelper::FRONTEND_DATE_FORMAT, $data['created_at']);

        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals($uuid, $data['uuid']);
        self::assertTrue(is_int($data['id']));
        self::assertTrue($createdAt instanceof DateTimeImmutable);
    }


    /**
     * @throws \JsonException
     */
    public function testNotExists(): void
    {
        $uuidRandom = Uuid::uuid4()->toString();

        $response = $this->app()->handle(
            self::json(
                'GET',
                $this->url . '?uuid=' . $uuidRandom
            )
        );
        $data = json_decode($response->getBody()->getContents(), true);

        self::assertEquals(409, $response->getStatusCode());
        self::assertEquals(
            'The Goods Transformer not found.',
            $data['message']
        );
    }

    /**
     * @throws \JsonException
     */
    public function testUrlNotFound(): void
    {
        $response = $this->app()->handle(
            self::json(
                'GET',
                $this->url . '__WRONG_URL__' . '/?uuid=' . GoodsTransformerFixture::UUID_1
            )
        );

        self::assertEquals(404, $response->getStatusCode());
    }

    /**
     * @throws \JsonException
     */
    public function testInvalidUUID(): void
    {
        $uuid = GoodsTransformerFixture::UUID_1 . '__WRONG_UUID__';

        $response = $this->app()->handle(
            self::json(
                'GET',
                $this->url . '?uuid=' . $uuid
            )
        );

        $data = json_decode($response->getBody()->getContents(), true);

        self::assertEquals(422, $response->getStatusCode());
        self::assertEquals('This is not a valid UUID.', $data['errors']['uuid']);
    }

    /**
     * @throws \JsonException
     */
    public function testEmpty(): void
    {
        $response = $this->app()->handle(
            self::json(
                'GET',
                $this->url
            )
        );

        $data = json_decode($response->getBody()->getContents(), true);

        self::assertEquals(422, $response->getStatusCode());
        self::assertEquals('This value should not be blank.', $data['errors']['uuid']);
    }
}