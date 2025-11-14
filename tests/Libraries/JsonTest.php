<?php

declare(strict_types=1);

namespace App\Tests\Libraries;

use App\Libraries\Json;
use PHPUnit\Framework\TestCase;
use stdClass;

class JsonTest extends TestCase
{
    private Json $json;

    protected function setUp(): void
    {
        $this->json = new Json();
    }

    // Tests for Tojson()
    public function test_Tojson_converts_array_to_json_string(): void
    {
        $input = ['name' => 'John', 'age' => 30];
        $result = $this->json->Tojson($input);
        
        $this->assertIsString($result);
        $this->assertJson($result);
        $this->assertStringContainsString('John', $result);
    }

    public function test_Tojson_converts_empty_array_to_json(): void
    {
        $result = $this->json->Tojson([]);
        
        $this->assertEquals('[]', $result);
    }

    public function test_Tojson_converts_object_to_json(): void
    {
        $obj = new stdClass();
        $obj->name = 'Jane';
        $obj->age = 25;
        
        $result = $this->json->Tojson($obj);
        
        $this->assertIsString($result);
        $this->assertStringContainsString('Jane', $result);
    }

    public function test_Tojson_converts_string_to_json(): void
    {
        $result = $this->json->Tojson('hello');
        
        $this->assertEquals('"hello"', $result);
    }

    public function test_Tojson_converts_number_to_json(): void
    {
        $result = $this->json->Tojson(42);
        
        $this->assertEquals('42', $result);
    }

    public function test_Tojson_converts_null_to_json(): void
    {
        $result = $this->json->Tojson(null);
        
        $this->assertEquals('null', $result);
    }

    // Tests for jsonToArray()
    public function test_jsonToArray_converts_json_to_array(): void
    {
        $json = '{"name":"John","age":30}';
        $result = $this->json->jsonToArray($json);
        
        $this->assertIsArray($result);
        $this->assertEquals('John', $result['name']);
        $this->assertEquals(30, $result['age']);
    }

    public function test_jsonToArray_converts_json_array_to_array(): void
    {
        $json = '["apple","banana","cherry"]';
        $result = $this->json->jsonToArray($json);
        
        $this->assertIsArray($result);
        $this->assertCount(3, $result);
        $this->assertContains('apple', $result);
    }

    public function test_jsonToArray_returns_null_for_invalid_json(): void
    {
        $result = $this->json->jsonToArray('invalid json');
        
        $this->assertNull($result);
    }

    public function test_jsonToArray_converts_empty_json_array(): void
    {
        $result = $this->json->jsonToArray('[]');
        
        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    // Tests for jsonToObject()
    public function test_jsonToObject_converts_json_to_object(): void
    {
        $json = '{"name":"John","age":30}';
        $result = $this->json->jsonToObject($json);
        
        $this->assertIsObject($result);
        $this->assertEquals('John', $result->name);
        $this->assertEquals(30, $result->age);
    }

    public function test_jsonToObject_returns_null_for_invalid_json(): void
    {
        $result = $this->json->jsonToObject('invalid json');
        
        $this->assertNull($result);
    }

    public function test_jsonToObject_converts_nested_json(): void
    {
        $json = '{"user":{"name":"John","age":30}}';
        $result = $this->json->jsonToObject($json);
        
        $this->assertIsObject($result);
        $this->assertIsObject($result->user);
        $this->assertEquals('John', $result->user->name);
    }

    // Tests for objectToArray()
    public function test_objectToArray_converts_object_to_array(): void
    {
        $obj = new stdClass();
        $obj->name = 'John';
        $obj->age = 30;
        
        $result = $this->json->objectToArray($obj);
        
        $this->assertIsArray($result);
        $this->assertEquals('John', $result['name']);
        $this->assertEquals(30, $result['age']);
    }

    public function test_objectToArray_converts_nested_objects(): void
    {
        $obj = new stdClass();
        $obj->user = new stdClass();
        $obj->user->name = 'John';
        
        $result = $this->json->objectToArray($obj);
        
        $this->assertIsArray($result);
        $this->assertIsArray($result['user']);
        $this->assertEquals('John', $result['user']['name']);
    }

    public function test_objectToArray_handles_empty_object(): void
    {
        $obj = new stdClass();
        $result = $this->json->objectToArray($obj);
        
        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    // Tests for ArrayToObject()
    public function test_ArrayToObject_converts_array_to_object(): void
    {
        $array = ['name' => 'John', 'age' => 30];
        $result = $this->json->ArrayToObject($array);
        
        $this->assertIsObject($result);
        $this->assertEquals('John', $result->name);
        $this->assertEquals(30, $result->age);
    }

    public function test_ArrayToObject_converts_nested_arrays(): void
    {
        $array = [
            'user' => [
                'name' => 'John',
                'age' => 30
            ]
        ];
        $result = $this->json->ArrayToObject($array);
        
        $this->assertIsObject($result);
        $this->assertIsObject($result->user);
        $this->assertEquals('John', $result->user->name);
    }

    public function test_ArrayToObject_handles_empty_array(): void
    {
        $result = $this->json->ArrayToObject([]);
        
        // Empty arrays become arrays, not objects
        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    public function test_ArrayToObject_preserves_numeric_arrays(): void
    {
        $array = ['apple', 'banana', 'cherry'];
        $result = $this->json->ArrayToObject($array);
        
        // Numeric arrays stay as arrays
        $this->assertIsArray($result);
        $this->assertCount(3, $result);
    }

    // Integration tests - round-trip conversions
    public function test_round_trip_array_to_json_to_array(): void
    {
        $original = ['name' => 'John', 'age' => 30];
        $json = $this->json->Tojson($original);
        $result = $this->json->jsonToArray($json);
        
        $this->assertEquals($original, $result);
    }

    public function test_round_trip_object_to_array_to_object(): void
    {
        $original = new stdClass();
        $original->name = 'John';
        $original->age = 30;
        
        $array = $this->json->objectToArray($original);
        $result = $this->json->ArrayToObject($array);
        
        $this->assertEquals($original, $result);
    }
}

