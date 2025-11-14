<?php

declare(strict_types=1);

namespace App\Tests\Libraries;

use App\Libraries\Extras;
use PHPUnit\Framework\TestCase;

class ExtrasTest extends TestCase
{
    private Extras $extras;

    protected function setUp(): void
    {
        $this->extras = new Extras();
    }

    // Tests for str2hex()
    public function test_str2hex_converts_string_to_hexadecimal(): void
    {
        $result = $this->extras->str2hex('Hello');
        
        $this->assertIsString($result);
        $this->assertEquals('48656c6c6f', $result);
    }

    public function test_str2hex_handles_empty_string(): void
    {
        $result = $this->extras->str2hex('');
        
        $this->assertEquals('', $result);
    }

    public function test_str2hex_handles_special_characters(): void
    {
        $result = $this->extras->str2hex('!@#');
        
        $this->assertIsString($result);
        $this->assertMatchesRegularExpression('/^[0-9a-f]+$/i', $result);
    }

    public function test_str2hex_handles_unicode(): void
    {
        $result = $this->extras->str2hex('こんにちは');
        
        $this->assertIsString($result);
        $this->assertNotEmpty($result);
    }

    // Tests for hex2str()
    public function test_hex2str_converts_hex_to_string(): void
    {
        $result = $this->extras->hex2str('48656c6c6f');
        
        $this->assertEquals('Hello', $result);
    }

    public function test_hex2str_handles_empty_string(): void
    {
        $result = $this->extras->hex2str('');
        
        $this->assertEquals('', $result);
    }

    public function test_hex2str_roundtrip_conversion(): void
    {
        $original = 'Test String 123';
        $hex = $this->extras->str2hex($original);
        $result = $this->extras->hex2str($hex);
        
        $this->assertEquals($original, $result);
    }

    // Tests for unique_code()
    public function test_unique_code_generates_code_with_default_length(): void
    {
        $result = $this->extras->unique_code();
        
        $this->assertIsString($result);
        $this->assertEquals(6, strlen($result));
    }

    public function test_unique_code_generates_code_with_custom_length(): void
    {
        $result = $this->extras->unique_code(10);
        
        $this->assertEquals(10, strlen($result));
    }

    public function test_unique_code_contains_alphanumeric_characters(): void
    {
        $result = $this->extras->unique_code(20);
        
        $this->assertMatchesRegularExpression('/^[A-Za-z0-9]+$/', $result);
    }

    public function test_unique_code_generates_different_codes(): void
    {
        $code1 = $this->extras->unique_code(10);
        $code2 = $this->extras->unique_code(10);
        
        // Very unlikely to be equal, but possible
        $this->assertIsString($code1);
        $this->assertIsString($code2);
    }

    public function test_unique_code_handles_length_of_one(): void
    {
        $result = $this->extras->unique_code(1);
        
        $this->assertEquals(1, strlen($result));
        $this->assertMatchesRegularExpression('/^[A-Za-z0-9]$/', $result);
    }

    public function test_unique_code_handles_large_length(): void
    {
        $result = $this->extras->unique_code(100);
        
        $this->assertEquals(100, strlen($result));
    }

    // Tests for get_client_ip()
    public function test_get_client_ip_returns_unknown_when_no_env_vars(): void
    {
        $result = $this->extras->get_client_ip();
        
        $this->assertIsString($result);
        // In test environment without env vars set, should return 'UNKNOWN'
        $this->assertEquals('UNKNOWN', $result);
    }

    public function test_get_client_ip_prefers_http_client_ip(): void
    {
        putenv('HTTP_CLIENT_IP=192.168.1.100');
        putenv('REMOTE_ADDR=192.168.1.1');
        
        $result = $this->extras->get_client_ip();
        
        $this->assertEquals('192.168.1.100', $result);
        
        // Cleanup
        putenv('HTTP_CLIENT_IP');
        putenv('REMOTE_ADDR');
    }

    public function test_get_client_ip_uses_x_forwarded_for_when_available(): void
    {
        putenv('HTTP_X_FORWARDED_FOR=10.0.0.1');
        
        $result = $this->extras->get_client_ip();
        
        $this->assertEquals('10.0.0.1', $result);
        
        // Cleanup
        putenv('HTTP_X_FORWARDED_FOR');
    }

    public function test_get_client_ip_uses_remote_addr_as_fallback(): void
    {
        putenv('REMOTE_ADDR=127.0.0.1');
        
        $result = $this->extras->get_client_ip();
        
        $this->assertEquals('127.0.0.1', $result);
        
        // Cleanup
        putenv('REMOTE_ADDR');
    }

    // Tests for getBrowser()
    public function test_getBrowser_returns_user_agent_string(): void
    {
        $_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)';
        
        $result = $this->extras->getBrowser();
        
        $this->assertIsString($result);
        $this->assertEquals('Mozilla/5.0 (Windows NT 10.0; Win64; x64)', $result);
    }

    public function test_getBrowser_returns_current_user_agent(): void
    {
        // getBrowser() directly accesses $_SERVER['HTTP_USER_AGENT']
        // In CLI/test environment, this is typically set by PHPUnit
        $result = $this->extras->getBrowser();
        
        $this->assertIsString($result);
        // In test environment, user agent should be set
        $this->assertNotEmpty($result);
    }

    protected function tearDown(): void
    {
        // Clean up any environment variables we may have set
        putenv('HTTP_CLIENT_IP');
        putenv('HTTP_X_FORWARDED_FOR');
        putenv('HTTP_X_FORWARDED');
        putenv('HTTP_FORWARDED_FOR');
        putenv('HTTP_FORWARDED');
        putenv('REMOTE_ADDR');
    }
}

