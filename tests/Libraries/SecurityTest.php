<?php

declare(strict_types=1);

namespace App\Tests\Libraries;

use App\Libraries\Security;
use PHPUnit\Framework\TestCase;

class SecurityTest extends TestCase
{
    private Security $security;

    protected function setUp(): void
    {
        $this->security = new Security();
    }

    // Tests for script()
    public function test_script_escapes_html_tags(): void
    {
        $input = '<script>alert("XSS")</script>';
        $result = $this->security->script($input);
        
        $this->assertStringContainsString('&lt;', $result);
        $this->assertStringContainsString('&gt;', $result);
        $this->assertStringNotContainsString('<script>', $result);
    }

    public function test_script_escapes_curly_braces(): void
    {
        $input = '{dangerous}';
        $result = $this->security->script($input);
        
        $this->assertStringContainsString('&#123;', $result);
        $this->assertStringContainsString('&#125;', $result);
        $this->assertStringNotContainsString('{', $result);
        $this->assertStringNotContainsString('}', $result);
    }

    public function test_script_escapes_forward_slash(): void
    {
        $input = 'path/to/file';
        $result = $this->security->script($input);
        
        $this->assertStringContainsString('&#47;', $result);
        $this->assertStringNotContainsString('/', $result);
    }

    public function test_script_converts_spaces_to_nbsp(): void
    {
        $input = 'hello world';
        $result = $this->security->script($input);
        
        $this->assertStringContainsString('&nbsp;', $result);
        $this->assertStringNotContainsString(' ', $result);
    }

    public function test_script_escapes_dollar_sign(): void
    {
        $input = '$variable';
        $result = $this->security->script($input);
        
        $this->assertStringContainsString('&#36;', $result);
        $this->assertStringNotContainsString('$', $result);
    }

    public function test_script_escapes_colon(): void
    {
        $input = 'http://example.com';
        $result = $this->security->script($input);
        
        $this->assertStringContainsString('&#58;', $result);
    }

    public function test_script_handles_empty_string(): void
    {
        $result = $this->security->script('');
        
        $this->assertEquals('', $result);
    }

    public function test_script_escapes_multiple_dangerous_characters(): void
    {
        $input = '<div>${user.name}</div>';
        $result = $this->security->script($input);
        
        $this->assertStringContainsString('&lt;', $result);
        $this->assertStringContainsString('&gt;', $result);
        $this->assertStringContainsString('&#36;', $result);
        $this->assertStringContainsString('&#123;', $result);
        $this->assertStringContainsString('&#125;', $result);
    }

    public function test_script_handles_plain_text(): void
    {
        $input = 'SimpleText123';
        $result = $this->security->script($input);
        
        // Should still have the text, but no dangerous chars
        $this->assertStringContainsString('SimpleText123', $result);
    }

    public function test_script_handles_xss_attempt_with_javascript(): void
    {
        $input = '<img src=x onerror=alert(1)>';
        $result = $this->security->script($input);
        
        $this->assertStringNotContainsString('<img', $result);
        // Note: spaces are converted to &nbsp; so "onerror" stays but is harmless
        $this->assertStringContainsString('&lt;', $result);
        $this->assertStringContainsString('&gt;', $result);
        $this->assertStringContainsString('&nbsp;', $result);
    }

    public function test_script_escapes_nested_html(): void
    {
        $input = '<div><span>text</span></div>';
        $result = $this->security->script($input);
        
        $allBrackets = substr_count($input, '<') + substr_count($input, '>');
        $escapedCount = substr_count($result, '&lt;') + substr_count($result, '&gt;');
        
        $this->assertEquals($allBrackets, $escapedCount);
    }

    public function test_script_handles_unicode_characters(): void
    {
        $input = 'Hello 世界';
        $result = $this->security->script($input);
        
        $this->assertStringContainsString('Hello', $result);
        $this->assertStringContainsString('世界', $result);
    }
}

