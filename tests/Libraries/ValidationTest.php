<?php

declare(strict_types=1);

namespace App\Tests\Libraries;

use App\Libraries\Validation;
use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{
    private Validation $validator;

    protected function setUp(): void
    {
        $this->validator = new Validation();
    }

    // Tests for required()
    public function test_required_returns_true_for_non_empty_string(): void
    {
        $result = $this->validator->required('hello');
        $this->assertTrue($result);
    }

    public function test_required_returns_false_for_empty_string(): void
    {
        $result = $this->validator->required('');
        $this->assertFalse($result);
    }

    public function test_required_returns_false_for_zero_string(): void
    {
        $result = $this->validator->required('0');
        $this->assertFalse($result);
    }

    public function test_required_returns_true_for_whitespace(): void
    {
        $result = $this->validator->required(' ');
        $this->assertTrue($result);
    }

    // Tests for alpha()
    public function test_alpha_returns_true_for_alphabetic_string(): void
    {
        $result = $this->validator->alpha('Hello');
        $this->assertTrue($result);
    }

    public function test_alpha_returns_false_for_string_with_numbers(): void
    {
        $result = $this->validator->alpha('Hello123');
        $this->assertFalse($result);
    }

    public function test_alpha_returns_false_for_string_with_spaces(): void
    {
        $result = $this->validator->alpha('Hello World');
        $this->assertFalse($result);
    }

    public function test_alpha_returns_false_for_empty_string(): void
    {
        $result = $this->validator->alpha('');
        $this->assertFalse($result);
    }

    // Tests for numeric()
    public function test_numeric_returns_true_for_numeric_string(): void
    {
        $result = $this->validator->numeric('12345');
        $this->assertTrue($result);
    }

    public function test_numeric_returns_false_for_string_with_letters(): void
    {
        $result = $this->validator->numeric('123abc');
        $this->assertFalse($result);
    }

    public function test_numeric_returns_false_for_negative_number(): void
    {
        $result = $this->validator->numeric('-123');
        $this->assertFalse($result);
    }

    public function test_numeric_returns_false_for_decimal_number(): void
    {
        $result = $this->validator->numeric('12.34');
        $this->assertFalse($result);
    }

    // Tests for alphanumeric()
    public function test_alphanumeric_returns_true_for_alphanumeric_string(): void
    {
        $result = $this->validator->alphanumeric('Hello123');
        $this->assertTrue($result);
    }

    public function test_alphanumeric_returns_false_for_string_with_spaces(): void
    {
        $result = $this->validator->alphanumeric('Hello 123');
        $this->assertFalse($result);
    }

    public function test_alphanumeric_returns_false_for_string_with_special_chars(): void
    {
        $result = $this->validator->alphanumeric('Hello@123');
        $this->assertFalse($result);
    }

    public function test_alphanumeric_returns_true_for_only_letters(): void
    {
        $result = $this->validator->alphanumeric('Hello');
        $this->assertTrue($result);
    }

    // Tests for alpha_space()
    public function test_alpha_space_returns_true_for_letters_with_spaces(): void
    {
        $result = $this->validator->alpha_space('Hello World');
        $this->assertTrue($result);
    }

    public function test_alpha_space_returns_false_for_string_with_numbers(): void
    {
        $result = $this->validator->alpha_space('Hello 123');
        $this->assertFalse($result);
    }

    public function test_alpha_space_returns_true_for_unicode_characters(): void
    {
        $result = $this->validator->alpha_space('Héllo Wörld');
        $this->assertTrue($result);
    }

    public function test_alpha_space_returns_false_for_special_characters(): void
    {
        $result = $this->validator->alpha_space('Hello@World');
        $this->assertFalse($result);
    }

    // Tests for email()
    public function test_email_returns_true_for_valid_email(): void
    {
        $result = $this->validator->email('test@example.com');
        $this->assertTrue($result);
    }

    public function test_email_returns_false_for_invalid_email_without_at(): void
    {
        $result = $this->validator->email('testexample.com');
        $this->assertFalse($result);
    }

    public function test_email_returns_false_for_invalid_email_without_domain(): void
    {
        $result = $this->validator->email('test@');
        $this->assertFalse($result);
    }

    public function test_email_returns_false_for_empty_string(): void
    {
        $result = $this->validator->email('');
        $this->assertFalse($result);
    }

    public function test_email_returns_true_for_email_with_subdomain(): void
    {
        $result = $this->validator->email('user@mail.example.com');
        $this->assertTrue($result);
    }

    // Tests for ip()
    public function test_ip_returns_true_for_valid_ipv4(): void
    {
        $result = $this->validator->ip('192.168.1.1');
        $this->assertTrue($result);
    }

    public function test_ip_returns_true_for_valid_ipv6(): void
    {
        $result = $this->validator->ip('2001:0db8:85a3:0000:0000:8a2e:0370:7334');
        $this->assertTrue($result);
    }

    public function test_ip_returns_false_for_invalid_ip(): void
    {
        $result = $this->validator->ip('999.999.999.999');
        $this->assertFalse($result);
    }

    public function test_ip_returns_false_for_non_ip_string(): void
    {
        $result = $this->validator->ip('not-an-ip');
        $this->assertFalse($result);
    }

    // Tests for url()
    public function test_url_returns_true_for_valid_http_url(): void
    {
        $result = $this->validator->url('http://example.com');
        $this->assertTrue($result);
    }

    public function test_url_returns_true_for_valid_https_url(): void
    {
        $result = $this->validator->url('https://example.com');
        $this->assertTrue($result);
    }

    public function test_url_returns_false_for_url_without_protocol(): void
    {
        $result = $this->validator->url('example.com');
        $this->assertFalse($result);
    }

    public function test_url_returns_false_for_invalid_url(): void
    {
        $result = $this->validator->url('not a url');
        $this->assertFalse($result);
    }

    public function test_url_returns_true_for_url_with_path(): void
    {
        $result = $this->validator->url('https://example.com/path/to/page');
        $this->assertTrue($result);
    }

    // Tests for minlength()
    public function test_minlength_returns_true_when_string_meets_minimum(): void
    {
        $result = $this->validator->minlength('hello', 5);
        $this->assertTrue($result);
    }

    public function test_minlength_returns_true_when_string_exceeds_minimum(): void
    {
        $result = $this->validator->minlength('hello world', 5);
        $this->assertTrue($result);
    }

    public function test_minlength_returns_false_when_string_below_minimum(): void
    {
        $result = $this->validator->minlength('hi', 5);
        $this->assertFalse($result);
    }

    public function test_minlength_returns_false_for_empty_string(): void
    {
        $result = $this->validator->minlength('', 1);
        $this->assertFalse($result);
    }

    // Tests for maxlength()
    public function test_maxlength_returns_true_when_string_within_maximum(): void
    {
        $result = $this->validator->maxlength('hello', 10);
        $this->assertTrue($result);
    }

    public function test_maxlength_returns_true_when_string_equals_maximum(): void
    {
        $result = $this->validator->maxlength('hello', 5);
        $this->assertTrue($result);
    }

    public function test_maxlength_returns_false_when_string_exceeds_maximum(): void
    {
        $result = $this->validator->maxlength('hello world', 5);
        $this->assertFalse($result);
    }

    public function test_maxlength_returns_true_for_empty_string(): void
    {
        $result = $this->validator->maxlength('', 5);
        $this->assertTrue($result);
    }

    // Tests for length_range()
    public function test_length_range_returns_true_when_string_within_range(): void
    {
        $result = $this->validator->length_range('hello', 3, 10);
        $this->assertTrue($result);
    }

    public function test_length_range_returns_true_when_string_equals_minimum(): void
    {
        $result = $this->validator->length_range('hello', 5, 10);
        $this->assertTrue($result);
    }

    public function test_length_range_returns_true_when_string_equals_maximum(): void
    {
        $result = $this->validator->length_range('hello', 3, 5);
        $this->assertTrue($result);
    }

    public function test_length_range_returns_false_when_string_below_minimum(): void
    {
        $result = $this->validator->length_range('hi', 5, 10);
        $this->assertFalse($result);
    }

    public function test_length_range_returns_false_when_string_exceeds_maximum(): void
    {
        $result = $this->validator->length_range('hello world', 3, 5);
        $this->assertFalse($result);
    }

    // Tests for equalTo()
    public function test_equalTo_returns_true_for_identical_strings(): void
    {
        $result = $this->validator->equalTo('hello', 'hello');
        $this->assertTrue($result);
    }

    public function test_equalTo_returns_false_for_different_strings(): void
    {
        $result = $this->validator->equalTo('hello', 'world');
        $this->assertFalse($result);
    }

    public function test_equalTo_returns_false_for_case_sensitive_comparison(): void
    {
        $result = $this->validator->equalTo('Hello', 'hello');
        $this->assertFalse($result);
    }

    public function test_equalTo_returns_true_for_empty_strings(): void
    {
        $result = $this->validator->equalTo('', '');
        $this->assertTrue($result);
    }

    public function test_equalTo_returns_true_for_numeric_strings(): void
    {
        $result = $this->validator->equalTo('123', '123');
        $this->assertTrue($result);
    }
}

