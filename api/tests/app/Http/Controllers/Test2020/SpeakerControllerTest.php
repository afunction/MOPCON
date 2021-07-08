<?php

namespace Tests\App\Http\Controllers\Test2020;

use TestCase;

class SpeakerControllerTest extends TestCase
{
    /**
     * @dataProvider envProvider
     */
    public function testGetSpeakerAPI($env, $assertCount)
    {
        /** arrange */
        putenv('APP_ENV=' . $env);

        /** act */
        $response = $this->call('GET', '/api/2020/speaker');
        $result = json_decode($response->getContent(), true);

        /** assert **/
        $this->assertEquals(true, $result['success']);
        $this->assertEquals($assertCount, count($result['data']));
        $this->assertJsonStringValidatedAgainstJsonSchemaFile('2020/speaker.json', $response->getContent());
    }

    public function testResourceFileNotFound()
    {
        /** arrange */
        putenv('RESOURCE_PATH=' . __DIR__ . '/../../../../');

        /** act */
        $response = $this->call('GET', '/api/2020/speaker');
        $result = json_decode($response->getContent(), true);

        /** assert **/
        $this->assertEquals(false, $result['success']);
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testGetSpeakerDetail()
    {
        /** arrange */
        putenv('APP_ENV=develop');

        /** act */
        $response = $this->call('GET', '/api/2020/speaker/1');
        $result = json_decode($response->getContent(), true);

        /** assert **/
        $this->assertEquals(true, $result['success']);
        $this->assertNotEmpty($result['data']);
        $this->assertJsonStringValidatedAgainstJsonSchemaFile('2020/speaker-show.json', $response->getContent());
    }

    public function testGetTags()
    {
        /** arrange */
        putenv('APP_ENV=develop');

        /** act */
        $response = $this->call('GET', '/api/2020/speaker/tags');
        $result = json_decode($response->getContent(), true);

        /** assert **/
        $this->assertEquals(true, $result['success']);
        $this->assertTrue(count($result['data']) > 0);
        $this->assertJsonStringValidatedAgainstJsonSchemaFile('2020/speaker-tags.json', $response->getContent());
    }

    public function envProvider()
    {
        return [
            [
                'develop',
                34
            ],
        ];
    }

    public function tearDown(): void
    {
        putenv('APP_ENV=testing');
        putenv('RESOURCE_PATH');
    }
}
