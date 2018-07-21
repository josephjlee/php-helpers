<p align="center">
<a href="https://packagist.org/packages/sebastiaanluca/php-helpers"><img src="https://poser.pugx.org/sebastiaanluca/php-helpers/version" alt="Latest stable release"></img></a>
<a href="LICENSE.md"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg" alt="Software license"></img></a>
<a href="https://travis-ci.org/sebastiaanluca/php-helpers"><img src="https://img.shields.io/travis/sebastiaanluca/php-helpers/master.svg" alt="Build status"></img></a>
<a href="https://packagist.org/packages/sebastiaanluca/php-helpers"><img src="https://img.shields.io/packagist/dt/sebastiaanluca/php-helpers.svg" alt="Total downloads"></img></a>
</p>

<p align="center">
<a href="https://blog.sebastiaanluca.com"><img src="https://img.shields.io/badge/link-blog-lightgrey.svg" alt="Read my blog"></img></a>
<a href="https://packagist.org/packages/sebastiaanluca"><img src="https://img.shields.io/badge/link-other_packages-lightgrey.svg" alt="View my other packages and projects"></img></a>
<a href="https://twitter.com/sebastiaanluca"><img src="https://img.shields.io/twitter/follow/sebastiaanluca.svg?style=social" alt="Follow @sebastiaanluca on Twitter"></img></a>
<a href="https://twitter.com/intent/tweet?text=Check%20out%20this%20extensive%20set%20of%20generic%20PHP%20helper%20functions%20and%20classes!%20Via%20@sebastiaanluca%20https://github.com/sebastiaanluca/php-helpers"><img src="https://img.shields.io/twitter/url/http/shields.io.svg?style=social" alt="Share this package on Twitter"></img></a>
</p>

# PHP Helpers

**An extensive set of PHP helper functions and classes.**

## Table of contents

- [Requirements](#requirements)
- [How to install](#how-to-install)
- [Global helper functions](#global-helper-functions)
    - [rand_bool](#rand_bool)
    - [str_wrap](#str_wrap)
    - [is\_assoc\_array](#is_assoc_array)
    - [array_expand](#array_expand)
    - [array_without](#array_without)
    - [array\_pull\_value](#array_pull_value)
    - [array\_pull\_values](#array_pull_values)
    - [array_hash](#array_hash)
    - [object_hash](#object_hash)
    - [has\_public\_method](#has_public_method)
    - [carbon](#carbon)
    - [create\_temporary\_file](#create_temporary_file)
- [Debug global helper functions](#debug-global-helper-functions)
    - [sss](#sss)
    - [ddd](#ddd)
    - [sss_if](#sss_if)
    - [ddd_if](#ddd_if)
- [Class helpers](#class-helpers)
    - [Constants trait](#constants-trait)
        - [Retrieving constants](#retrieving-constants)
        - [Retrieving constant keys](#retrieving-constant-keys)
        - [Retrieving constant values](#retrieving-constant-values)
    - [ProvidesClassInfo trait](#providesclassinfo-trait)
    - [MethodHelper](#methodhelper)
- [License](#license)
- [Change log](#change-log)
- [Testing](#testing)
- [Contributing](#contributing)
- [Security](#security)
- [Credits](#credits)
- [About](#about)

## Requirements

- PHP 7.2 or higher

## How to install

Via Composer:

```bash
composer require sebastiaanluca/php-helpers
```

All function helpers will be enabled by default (if those functions haven't already been defined). Class helpers are enabled per-case when used.

You can find more info on how to use a helper and what there requirements are in their respective section (see the table of contents above for an overview).

## Global helper functions

### rand_bool

Randomly return `true` or `false`.

```php
rand_bool();

// true
```

### str_wrap

Wrap a string with another string.

```php
str_wrap('foo', '*');

// "*foo*"
```

### is\_assoc\_array

Check if an array is associative.

Performs a simple check to determine if the given array's keys are numeric, start at 0, and count up to the amount of values it has.

```php
is_assoc_array(['color' => 'blue', 'age' => 31]);

// true
```

```php
is_assoc_array([0 => 'blue', 7 => 31]);

// true
```

```php
is_assoc_array(['blue', 31]);

// false
```

```php
is_assoc_array([0 => 'blue', 1 => 31]);

// false
```

### array_expand

Expand a flat dotted array into a multi-dimensional associative array.

If a key is encountered that is already present and the existing value is an array, each new value will be added to that array. If it's not an array, each new value will override the existing one.

```php
array_expand(['products.desk.price' => 200]);

/*
[
    "products" => [
        "desk" => [
            "price" => 200,
        ],
    ],
]
*/
```

### array_without

Get the array without the given values.

Accepts either an array or a value as parameter to remove.

```php
$cars = ['bmw', 'mercedes', 'audi'];
$soldOut = ['audi', 'bmw'];

$inStock = array_without($cars, $soldOut);

// ["mercedes"]
```

```php
array_without(['one', 'two', 'three'], 'two');

// ["one", "three"]
```

### array\_pull\_value

Pull a single value from a given array.

Returns the given value if it was successfully removed from the source array or `null` if it was not found.

```php
$source = ['A', 'B', 'C'];

$removed = array_pull_value($source, 'C');

// $removed = "C"
// $source = ["A", "B"]
```

### array\_pull\_values

Pull an array of values from a given array.

Returns the values that were successfully removed from the source array or an empty array if none were found.

```php
$source = ['A', 'B', 'C'];
$removed = array_pull_values($source, ['A', 'B']);

// $removed = ["A", "B"]
// $source = ["C"]
```

### array_hash

Create a unique string identifier for an array.

The identifier will be entirely unique for each combination of keys and values.

```php
array_hash([1, 2, 3]);

// "262bbc0aa0dc62a93e350f1f7df792b9"
```

```php
array_hash(['hash' => 'me']);

// "f712e79b502bda09a970e2d4d47e3f88"
```

### object_hash

Create a unique string identifier for an object.

Similar to [array_hash](#array_hash), this uses `serialize` to *stringify* all public properties first. The identifier will be entirely unique based on the object class, properties, and its values.

```php
class ValueObject {
    public $property = 'randomvalue';
}

object_hash(new ValueObject);

// "f39eaea7a1cf45f5a0c813d71b5f2f57"
```

### has\_public\_method

Check if a class has a certain public method.

```php
class Hitchhiker {
    public function answer() {
        return 42;
    }
}

has_public_method(Hitchhiker::class, 'answer');

// true

has_public_method(new Hitchhiker, 'answer');

// true
```

### carbon

Create a Carbon datetime object from a string or return a new object referencing the current date and time.

Requires the [nesbot/carbon](https://github.com/briannesbitt/Carbon) package.

```php
carbon('2017-01-18 11:30');

/*
Carbon\Carbon {
    "date": "2017-01-18 11:30:00.000000",
    "timezone_type": 3,
    "timezone": "UTC",
}
*/

carbon();

/*
Carbon\Carbon {
    "date": "2017-10-27 16:18:00.000000",
    "timezone_type": 3,
    "timezone": "UTC",
}
*/
```

### create\_temporary\_file

Create a temporary file.

Returns an array with the file handle (resource) and the full path as string.

The temporary file is readable and writeable by default. The file is automatically removed when closed (for example, by calling fclose() on the handle, or when there are no remaining references to the file handle), or when the script ends.

See [](http://php.net/manual/en/function.tmpfile.php) for more information.

```php
create_temporary_file();

/*
[
    "file" => stream resource {
        timed_out: false
        blocked: true
        eof: false
        wrapper_type: "plainfile"
        stream_type: "STDIO"
        mode: "r+b"
        unread_bytes: 0
        seekable: true
        uri: "/tmp/phpxm4bcZ"
        options: []
    }
    "path" => "/tmp/phpxm4bcZ"
]
*/
```

## Global debug helper functions

### sss

Display structured debug information about one or more values **in plain text** using Kint and halt script execution afterwards. Accepts multiple arguments to dump.

Output will be identical to `ddd` when used in a command line interface. In a browser, it'll display plain, but structured text.

Requires the [kint-php/kint](https://github.com/raveren/kint) package.

```php
sss('string');

/*
┌─────────────────────────────────────────┐
│ literal                                 │
└─────────────────────────────────────────┘
string (6) "string"
═══════════════════════════════════════════
Called from .../src/MyClass.php:42
*/

sss('string', 0.42, ['array']);

/*
┌─────────────────────────────────────────┐
│ literal                                 │
└─────────────────────────────────────────┘
string (6) "string"
┌─────────────────────────────────────────┐
│ literal                                 │
└─────────────────────────────────────────┘
double 0.42
┌─────────────────────────────────────────┐
│ literal                                 │
└─────────────────────────────────────────┘
array (1) [
    0 => string (5) "array"
]
═══════════════════════════════════════════
Called from .../src/MyClass.php:42
*/
```

### ddd

Display structured debug information about one or more values using Kint and halt script execution afterwards. Accepts multiple arguments to dump. Output will be identical to `sss` when used in a command line interface. In a browser, it'll display an interactive, structured tree-view.

Requires the [kint-php/kint](https://github.com/raveren/kint) package.

See the [sss helper](#sss) for example output.

### sss_if

Display structured debug information about one or more values **in plain text** using Kint and halt script execution afterwards, but only if the condition is truthy. Does nothing if falsy. Accepts multiple arguments to dump.

Requires the [kint-php/kint](https://github.com/raveren/kint) package.

```php
sss_if($user->last_name, 'User has a last name', $user->last_name);
```

See the [sss helper](#sss) for example output.

### ddd_if

Display structured debug information about one or more values using Kint and halt script execution afterwards, but only if the condition is truthy. Does nothing if falsy. Accepts multiple arguments to dump.

Requires the [kint-php/kint](https://github.com/raveren/kint) package.

```php
ddd_if(app()->environment('local'), 'Debugging in a local environment!');
```

See the [ddd helper](#ddd) for example output.

## Class helpers

### Constants trait

The primary use of the `Constants` trait is to enable you to store all constants of a specific type in a single class or value object and have it return those with a single call.

This can be useful for instance when your database uses integers to store states, but you want to use descriptive strings throughout your code (i.e. enums). It also allows you to refactor these constants at any time without having to waste time searching your code for any raw values (and probably miss a few, introducing new bugs along the way).

#### Retrieving constants

Returns an array of constant keys and their values.

```php
<?php

use SebastiaanLuca\PhpHelpers\Classes\Constants;

class UserStates
{
    use Constants;

    public const REGISTERED = 'registered';
    public const ACTIVATED = 'activated';
    public const DISABLED = 'disabled';
}

UserStates::constants();

// or

(new UserStates)->constants();

/*
[
    "REGISTERED" => "registered",
    "ACTIVATED" => "activated",
    "DISABLED" => "disabled",
]
*/
```

#### Retrieving constant keys

Returns all the keys of constants in a class.

```php
<?php

use SebastiaanLuca\PhpHelpers\Classes\Constants;

class UserStates
{
    use Constants;

    public const REGISTERED = 'registered';
    public const ACTIVATED = 'activated';
    public const DISABLED = 'disabled';
}

UserStates::keys();

/*
[
    "REGISTERED",
    "ACTIVATED",
    "DISABLED",
]
*/
```

#### Retrieving constant values

Returns all the values of constants in a class.

```php
<?php

use SebastiaanLuca\PhpHelpers\Classes\Constants;

class UserStates
{
    use Constants;

    public const REGISTERED = 'registered';
    public const ACTIVATED = 'activated';
    public const DISABLED = 'disabled';
}

UserStates::values();

/*
[
    "registered",
    "activated",
    "disabled",
]
*/
```

### ProvidesClassInfo trait

The `ProvidesClassInfo` trait provides an easy-to-use `getClassDirectory()` helper method that returns the directory of the current class.

```php
<?php

namespace Kyle\Helpers;

use SebastiaanLuca\PhpHelpers\Classes\ProvidesClassInfo;

class MyClass
{
    use ProvidesClassInfo;

    public function __construct()
    {
        var_dump($this->getClassDirectory());
    }
}

// "/Users/Kyle/Projects/php-helpers"
```

### MethodHelper

A static class helper to help you figure out the visibility/accessibility of an object's methods.

```php
<?php

class SomeClass
{
    private function aPrivateMethod() : string
    {
        return 'private';
    }

    protected function aProtectedMethod() : string
    {
        return 'protected';
    }

    public function aPublicMethod() : string
    {
        return 'public';
    }
}

MethodHelper::hasMethodOfType($class, 'aPrivateMethod', 'private');

// true

MethodHelper::hasProtectedMethod($class, 'aProtectedMethod');

// true

MethodHelper::hasPublicMethod($class, 'aPublicMethod');

// true

MethodHelper::hasProtectedMethod($class, 'aPrivateMethod');

// false

MethodHelper::hasPublicMethod($class, 'invalidMethod');

// false
```

## License

This package operates under the MIT License (MIT). Please see [LICENSE](LICENSE.md) for more information.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

```bash
composer install
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email [hello@sebastiaanluca.com][link-author-email] instead of using the issue tracker.

## Credits

- [Sebastiaan Luca][link-github-profile]
- Logo by [Vitor Caneco](https://github.com/caneco)
- [All Contributors][link-contributors]

## About

My name is Sebastiaan and I'm a freelance back-end developer specializing in building custom Laravel applications. Check out my [portfolio][link-portfolio] for more information, [my blog][link-blog] for the latest tips and tricks, and my other [packages][link-packages] to kick-start your next project.

Have a project that could use some guidance? Send me an e-mail at [hello@sebastiaanluca.com][link-author-email]!

[link-packagist]: https://packagist.org/packages/sebastiaanluca/php-helpers
[link-travis]: https://travis-ci.org/sebastiaanluca/php-helpers
[link-contributors]: ../../contributors

[link-portfolio]: https://www.sebastiaanluca.com
[link-blog]: https://blog.sebastiaanluca.com
[link-packages]: https://packagist.org/packages/sebastiaanluca
[link-github-profile]: https://github.com/sebastiaanluca
[link-author-email]: mailto:hello@sebastiaanluca.com