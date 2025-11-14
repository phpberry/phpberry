# PHPBerry - Quick Class Reference Guide

## 🚀 Quick Start

All system classes are now autoloaded via Composer. Simply use `require 'config/bootstrap.php'` and add your `use` statements.

```php
<?php
require 'config/bootstrap.php';

use App\Libraries\Validation;
use App\Libraries\Json;
use App\Models\Dynamic;

// Ready to use!
$validator = new Validation();
$json = new Json();
$dynamic = new Dynamic();
```

---

## 📚 Complete Class Reference

### Libraries (9 classes)

#### Validation
```php
use App\Libraries\Validation;

$val = new Validation();
$val->required($string);
$val->email($string);
$val->alpha($string);
$val->numeric($string);
$val->alphanumeric($string);
$val->minlength($string, $min);
$val->maxlength($string, $max);
```

#### Json
```php
use App\Libraries\Json;

$json = new Json();
$json->Tojson($input);
$json->jsonToArray($json);
$json->jsonToObject($json);
$json->objectToArray($object);
$json->ArrayToObject($array);
```

#### Email
```php
use App\Libraries\Email;

$email = new Email();
$email->email($to, $from, $subject, $message, $cc = null);
```

#### CMail (with attachments)
```php
use App\Libraries\CMail;

$mail = new CMail();
$mail->mail($to, $from, $subject, $message, $file = "");
```

#### Security
```php
use App\Libraries\Security;

$sec = new Security();
$sanitized = $sec->script($string); // XSS protection
```

#### Pagination
```php
use App\Libraries\Pagination;

$page = new Pagination();
list($show_page, $tpages, $total_pages, $start, $end) = 
    $page->paginate_data($page, $total_results, $per_page);
$html = $page->paginate($reload, $show_page, $total_pages, $get = false);
```

#### UploadFile
```php
use App\Libraries\UploadFile;

$uploader = new UploadFile();
$config = [
    'file' => $_FILES["fileToUpload"]["name"],
    'rename' => true,
    'isimage' => true,
    'overwrite' => false,
    'minsize' => 50, // KB
    'maxsize' => 2000, // KB
    'format' => ['jpg', 'png', 'gif'],
    'foldername' => 'uploads'
];
$result = $uploader->upload_file($config);
$result = $uploader->delete_file($filename, $foldername);
```

#### Extras
```php
use App\Libraries\Extras;

$extras = new Extras();
$extras->str2hex($str);
$extras->hex2str($hex);
$extras->unique_code($length = 6);
$extras->get_client_ip();
$extras->getBrowser();
```

#### Encrypt
```php
use App\Libraries\Encrypt;

$encrypt = new Encrypt();
$encrypted = $encrypt->encrypt_url($data);
$decrypted = $encrypt->decrypt_url($data);
```

---

### Models (1 class)

#### Dynamic (Database Operations)
```php
use App\Models\Dynamic;

$db = new Dynamic();

// INSERT
$db->insert($table, $fieldvalue, $returnId = false);

// UPDATE
$db->update($table, $updatefield, $wherefield = [], $con = 'AND');

// DELETE
$db->delete($table, $wherefield = [], $con = 'AND');

// SELECT
$db->select($table, $wherefield = [], $fatchfield = [], $con = 'AND');

// COUNT
$db->count($table, $wherefield = [], $con = 'AND');

// DISTINCT
$db->distinct($table, $wherefield = [], $fatchfield = [], $con = 'AND');

// TABLE OPERATIONS
$db->deletetable($table);
$db->emptytable($table); // TRUNCATE
$db->renametable($table, $newName);

// JOINS
$db->sqljoin($fatchfield = [], $compare, $type = "IJ");
// Types: IJ, LOJ, ROJ, FOJ
```

---

### Hooks (5 classes)

#### ErrorConfig
```php
use App\Hooks\ErrorConfig;

// Initialize error handling (automatically called in bootstrap)
ErrorConfig::init();
```

#### ExecutionConfig
```php
use App\Hooks\ExecutionConfig;

// Set max execution time
ExecutionConfig::init($seconds = 300);
```

#### Compress
```php
use App\Hooks\Compress;

// Initialize output compression
Compress::init();
```

#### DeveloperOptionBlock
```php
use App\Hooks\DeveloperOptionBlock;

// Render developer tools blocker
DeveloperOptionBlock::render();
```

#### UrlFunctions (Global Functions)
These are globally available after bootstrap:
```php
// Flash messages
flash('success', 'Operation completed!'); // Set
flash('success'); // Display and clear

// URL segments
$segment = segment(0); // Get URL segment

// Redirect
redirect('https://example.com');
```

---

### Config (2 classes)

#### Database
```php
use App\Config\Database;

// Extends PDO with default connection
$db = new Database();
```

#### BaseModel
```php
use App\Config\BaseModel;

// Extend this for your models
class MyModel extends BaseModel {
    public function __construct() {
        parent::__construct();
    }
}
```

---

## 🔧 Custom Model Example

```php
<?php

use App\Config\BaseModel;
use PDO;

class UserModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $sth = $this->prepare($sql);
        $sth->bindParam(':id', $id);
        $sth->execute();
        $sth->setFetchMode(PDO::FETCH_OBJ);
        return $sth->fetch();
    }
    
    public function getAllUsers()
    {
        $sql = "SELECT * FROM users ORDER BY name";
        $sth = $this->query($sql);
        $sth->setFetchMode(PDO::FETCH_OBJ);
        return $sth->fetchAll();
    }
}
```

---

## 📦 Adding New Classes

1. Create the class file in the appropriate `App/` subdirectory
2. Add the correct namespace
3. Run `composer dump-autoload`
4. Use the class with a `use` statement

Example:
```php
// File: App/Libraries/MyHelper.php
<?php

declare(strict_types=1);

namespace App\Libraries;

class MyHelper
{
    public function doSomething()
    {
        // Your code here
    }
}
```

Usage:
```php
<?php
require 'config/bootstrap.php';

use App\Libraries\MyHelper;

$helper = new MyHelper();
$helper->doSomething();
```

---

## ⚠️ Important Notes

1. **Always run `composer dump-autoload`** after adding/moving classes
2. **Namespace must match directory structure**:
   - `App/Libraries/MyClass.php` → `namespace App\Libraries;`
3. **Use `use` statements** at the top of files
4. **Bootstrap loads autoloader** - just require `config/bootstrap.php`

---

## 🔄 Migration Checklist for Legacy Code

- [ ] Replace `new CP_Lvalidation()` with `new Validation()`
- [ ] Replace `new CP_Mdynamic()` with `new Dynamic()`
- [ ] Add `use App\...` statements at the top
- [ ] Ensure `config/bootstrap.php` is loaded
- [ ] Update models to extend `BaseModel` instead of `base_model`

---

**Last Updated**: November 14, 2025  
**Namespace**: `App\`  
**PSR-4**: ✅ Active  
**PHP Version**: >= 8.3

