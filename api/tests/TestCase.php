<?php

use JsonSchema\Validator;

abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    /**
     * Assert that a JSON string is valid under the given JSON Schema file
     *
     * @param object $expectedJsonSchemaFile filename of the JSON Schema file
     * @param string $actualJson
     * @param string $baseUri URI prefix of schema files
     */
    public function assertJsonStringValidatedAgainstJsonSchemaFile($expectedJsonSchemaFile, $actualJson, $baseUri = __DIR__ . '/spec/json')
    {
        $schemaUri = sprintf('%s/%s', $baseUri, $expectedJsonSchemaFile);
        $schema = json_decode(file_get_contents($schemaUri));

        $json = $actualJson;
        if (is_string($actualJson)) {
            $json = json_decode($actualJson);
        }

        $validator = new Validator();
        $validator->validate($json, $schema);

        $this->assertTrue($validator->isValid(), json_encode($validator->getErrors(), JSON_PRETTY_PRINT));
    }
}
