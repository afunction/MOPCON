<?php

namespace Tests\App\Http\Controllers\Test2019;

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
        $response = $this->call('GET', '/api/2019/speaker');
        $result = json_decode($response->getContent(), true);

        /** assert **/
        $this->assertEquals(true, $result['success']);
        $this->assertEquals($assertCount, count($result['data']));
        $this->assertJsonStringValidatedAgainstJsonSchemaFile('2019/speaker.json', $response->getContent());
    }

    public function testResourceFileNotFound()
    {
        /** arrange */
        putenv('RESOURCE_PATH=' . __DIR__ . '/../../../../');

        /** act */
        $response = $this->call('GET', '/api/2019/speaker');
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
        $response = $this->call('GET', '/api/2019/speaker/1');
        $result = json_decode($response->getContent(), true);

        /** assert **/
        $this->assertEquals(true, $result['success']);
        $this->assertNotEmpty($result['data']);
    }

    public function testGetTags()
    {
        /** arrange */
        putenv('APP_ENV=develop');

        /** act */
        $response = $this->call('GET', '/api/2019/speaker/tags');
        $result = json_decode($response->getContent(), true);

        /** assert **/
        $this->assertEquals(true, $result['success']);
        $this->assertTrue(count($result['data']) > 0);
    }

    public function envProvider()
    {
        return [
            [
                'develop',
                42
            ],
        ];
    }

    public function tearDown(): void
    {
        putenv('APP_ENV=testing');
        putenv('RESOURCE_PATH');
    }
}
