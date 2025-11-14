# ✅ PHPUnit 12 Testing Setup Complete

## 🎉 Testing Framework Successfully Integrated!

Your PHPBerry framework now has **PHPUnit 12** fully configured and ready for Test-Driven Development (TDD).

---

## 📊 Installation Summary

| Component | Version | Status |
|-----------|---------|--------|
| **PHPUnit** | 12.4.3 | ✅ Installed |
| **PHP Version** | 8.3.27 | ✅ Compatible |
| **Test Framework** | PSR-4 | ✅ Configured |
| **Code Coverage** | Available | ✅ Ready |

---

## 🚀 Quick Start

### Running Tests

```bash
# Run all tests
composer test

# Or use PHPUnit directly
./vendor/bin/phpunit

# Run with code coverage
composer test:coverage
```

### Verification

```bash
$ composer test
> phpunit
PHPUnit 12.4.3 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.3.27
Configuration: /var/www/Packages/phpberry/phpunit.xml.dist

.                                                                   1 / 1 (100%)

Time: 00:00.001, Memory: 14.00 MB

OK (1 test, 1 assertion)
```

✅ **All tests passing!**

---

## 📁 Project Structure

```
phpberry/
├── App/                        # Application code
│   ├── Config/
│   ├── Hooks/
│   ├── Libraries/
│   └── Models/
├── tests/                      # Test files ✅ NEW
│   └── ExampleTest.php        # Sample test
├── vendor/                     # Dependencies
│   └── bin/
│       └── phpunit            # PHPUnit executable
├── composer.json              # ✅ Updated with test config
├── phpunit.xml.dist           # ✅ PHPUnit configuration
└── .phpunit.cache/            # Test cache (auto-created)
```

---

## ⚙️ Configuration Files

### 1. composer.json

```json
{
  "require": {
    "php": ">=8.3"
  },
  "require-dev": {
    "phpunit/phpunit": "^12.0"
  },
  "autoload": {
    "psr-4": {
      "App\\": "App/"
    }
  },
  "autoload-dev": {
    "psr-4": {
      "App\\Tests\\": "tests/"
    }
  },
  "scripts": {
    "test": "phpunit",
    "test:coverage": "phpunit --coverage-html coverage"
  }
}
```

**Key Points:**
- ✅ PHPUnit 12 in `require-dev`
- ✅ Test namespace `App\Tests\` maps to `tests/`
- ✅ Convenient `composer test` script
- ✅ Code coverage script available

### 2. phpunit.xml.dist

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://schema.phpunit.de/12.0/phpunit.xsd"
    bootstrap="vendor/autoload.php"
    colors="true"
    cacheDirectory=".phpunit.cache"
>
  <testsuites>
    <testsuite name="Unit">
      <directory>./tests</directory>
    </testsuite>
  </testsuites>

  <source>
    <include>
      <directory>./App</directory>
    </include>
  </source>
</phpunit>
```

**Configuration:**
- ✅ Autoloader bootstrap
- ✅ Colored output
- ✅ Test caching enabled
- ✅ Code coverage for `App/` directory

---

## 📝 Writing Tests

### Example Test Structure

```php
<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }
}
```

**Naming Conventions:**
- Test files: `*Test.php`
- Test methods: `test_*` or use `@test` annotation
- Namespace: `App\Tests\` (matches `tests/` directory)

---

## 🎯 Real-World Test Examples

### Testing a Model

```php
<?php

declare(strict_types=1);

namespace App\Tests\Models;

use App\Models\Page;
use PHPUnit\Framework\TestCase;

class PageTest extends TestCase
{
    private Page $page;
    
    protected function setUp(): void
    {
        $this->page = new Page();
    }
    
    public function test_count_countries_returns_integer(): void
    {
        $count = $this->page->countCountries();
        
        $this->assertIsInt($count);
        $this->assertGreaterThanOrEqual(0, $count);
    }
    
    public function test_all_countries_returns_array(): void
    {
        $countries = $this->page->allCountries(0, 10);
        
        $this->assertIsArray($countries);
    }
}
```

### Testing a Library

```php
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
    
    public function test_valid_email_passes(): void
    {
        $result = $this->validator->email('test@example.com');
        
        $this->assertTrue($result);
    }
    
    public function test_invalid_email_fails(): void
    {
        $result = $this->validator->email('not-an-email');
        
        $this->assertFalse($result);
    }
    
    public function test_required_with_value_passes(): void
    {
        $result = $this->validator->required('some value');
        
        $this->assertTrue($result);
    }
    
    public function test_required_with_empty_string_fails(): void
    {
        $result = $this->validator->required('');
        
        $this->assertFalse($result);
    }
}
```

---

## 🎨 Test Organization

### Recommended Structure

```
tests/
├── Unit/                      # Unit tests
│   ├── Config/
│   │   ├── BaseModelTest.php
│   │   └── DatabaseTest.php
│   ├── Libraries/
│   │   ├── ValidationTest.php
│   │   ├── JsonTest.php
│   │   ├── EmailTest.php
│   │   └── SecurityTest.php
│   └── Models/
│       ├── PageTest.php
│       ├── UserTest.php
│       └── DynamicTest.php
├── Feature/                   # Feature/Integration tests
│   └── UserAuthenticationTest.php
└── ExampleTest.php           # Smoke test
```

---

## 📊 Code Coverage

### Generate Coverage Report

```bash
# HTML coverage report
composer test:coverage

# View in browser
open coverage/index.html
```

### Coverage Configuration

Add to `phpunit.xml.dist` for coverage filters:

```xml
<coverage>
  <include>
    <directory suffix=".php">./App</directory>
  </include>
  <exclude>
    <directory suffix=".php">./App/Config</directory>
  </exclude>
</coverage>
```

---

## 🔧 Common Commands

```bash
# Run all tests
composer test

# Run specific test file
./vendor/bin/phpunit tests/ExampleTest.php

# Run specific test method
./vendor/bin/phpunit --filter test_that_true_is_true

# Run with coverage
composer test:coverage

# Run with verbose output
./vendor/bin/phpunit --verbose

# Run tests in specific directory
./vendor/bin/phpunit tests/Unit/Libraries

# Stop on first failure
./vendor/bin/phpunit --stop-on-failure

# Display test execution order
./vendor/bin/phpunit --order-by=default
```

---

## 🎯 PHPUnit Assertions

### Common Assertions

```php
// Boolean assertions
$this->assertTrue($value);
$this->assertFalse($value);

// Equality assertions
$this->assertEquals($expected, $actual);
$this->assertSame($expected, $actual); // Strict comparison

// Type assertions
$this->assertIsInt($value);
$this->assertIsString($value);
$this->assertIsArray($value);
$this->assertIsBool($value);

// Comparison assertions
$this->assertGreaterThan(10, $value);
$this->assertLessThan(100, $value);
$this->assertGreaterThanOrEqual(0, $value);

// Array assertions
$this->assertContains('item', $array);
$this->assertArrayHasKey('key', $array);
$this->assertCount(5, $array);
$this->assertEmpty($array);
$this->assertNotEmpty($array);

// String assertions
$this->assertStringContainsString('substring', $string);
$this->assertStringStartsWith('prefix', $string);
$this->assertStringEndsWith('suffix', $string);
$this->assertMatchesRegularExpression('/pattern/', $string);

// Exception assertions
$this->expectException(InvalidArgumentException::class);
$this->expectExceptionMessage('Error message');
```

---

## 🏗️ Best Practices

### 1. Test Naming

```php
// ✅ Good - descriptive
public function test_validation_fails_for_invalid_email(): void

// ❌ Bad - unclear
public function testValidation(): void
```

### 2. Arrange-Act-Assert Pattern

```php
public function test_user_can_be_authenticated(): void
{
    // Arrange
    $user = new User();
    $email = 'test@example.com';
    $password = 'password123';
    
    // Act
    $result = $user->authenticateUser($email, $password);
    
    // Assert
    $this->assertTrue($result);
}
```

### 3. Use setUp() and tearDown()

```php
class UserTest extends TestCase
{
    private User $user;
    
    protected function setUp(): void
    {
        // Runs before each test
        $this->user = new User();
    }
    
    protected function tearDown(): void
    {
        // Runs after each test
        // Clean up resources
    }
}
```

### 4. Test One Thing Per Test

```php
// ✅ Good - focused
public function test_email_validation_passes_for_valid_email(): void
{
    $result = $this->validator->email('test@example.com');
    $this->assertTrue($result);
}

public function test_email_validation_fails_for_invalid_email(): void
{
    $result = $this->validator->email('invalid');
    $this->assertFalse($result);
}

// ❌ Bad - testing multiple things
public function test_email_validation(): void
{
    $this->assertTrue($this->validator->email('test@example.com'));
    $this->assertFalse($this->validator->email('invalid'));
    $this->assertTrue($this->validator->email('another@test.com'));
}
```

---

## 📚 Next Steps

### 1. Write Tests for Existing Code

Start with:
- ✅ `App\Libraries\Validation` - Easy to test, pure functions
- ✅ `App\Libraries\Json` - Simple transformation logic
- ✅ `App\Libraries\Security` - Important to test

### 2. Add Data Providers

```php
/**
 * @dataProvider emailProvider
 */
public function test_email_validation(string $email, bool $expected): void
{
    $result = $this->validator->email($email);
    $this->assertSame($expected, $result);
}

public static function emailProvider(): array
{
    return [
        ['test@example.com', true],
        ['invalid', false],
        ['another@test.com', true],
        ['@example.com', false],
    ];
}
```

### 3. Add Continuous Integration

Create `.github/workflows/tests.yml`:

```yaml
name: Tests

on: [push, pull_request]

jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.3'
      - name: Install dependencies
        run: composer install
      - name: Run tests
        run: composer test
```

---

## 🐛 Troubleshooting

### Issue: Tests not found

**Solution**: Regenerate autoloader
```bash
composer dump-autoload
```

### Issue: Class not found in tests

**Solution**: Check namespace matches directory structure
- `tests/Unit/LibrariesTest.php` → `namespace App\Tests\Unit;`

### Issue: PHPUnit not found

**Solution**: Reinstall dev dependencies
```bash
composer install --dev
```

---

## 📞 Quick Reference

| Command | Description |
|---------|-------------|
| `composer test` | Run all tests |
| `composer test:coverage` | Generate coverage report |
| `./vendor/bin/phpunit --filter testName` | Run specific test |
| `./vendor/bin/phpunit --stop-on-failure` | Stop on first failure |
| `composer dump-autoload` | Regenerate autoloader |

---

## ✅ Verification Checklist

- [x] ✅ PHPUnit 12.4.3 installed
- [x] ✅ `tests/` directory created
- [x] ✅ `phpunit.xml.dist` configured
- [x] ✅ `composer test` script working
- [x] ✅ Example test passing
- [x] ✅ Autoloader configured for `App\Tests\`
- [x] ✅ Code coverage available

---

**🏁 Status**: ✅ **Testing Framework Complete**  
**📅 Date**: November 14, 2025  
**⚡ PHPUnit**: 12.4.3  
**📦 PHP**: 8.3.27  
**🎯 Tests**: 1 passing  

---

**Your framework is now ready for Test-Driven Development! 🚀**

Start writing tests with `composer test` 🧪

