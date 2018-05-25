# Bright Components - Responders
### A Responder Implementation for Laravel Projects.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bright-components/responders.svg)](https://packagist.org/packages/bright-components/responders)
[![Build Status](https://img.shields.io/travis/bright-components/responders/master.svg)](https://travis-ci.org/bright-components/responders)
[![Quality Score](https://img.shields.io/scrutinizer/g/bright-components/responders.svg)](https://scrutinizer-ci.com/g/bright-components/responders)
[![Total Downloads](https://img.shields.io/packagist/dt/bright-components/responders.svg)](https://packagist.org/packages/bright-components/responders)

![Bright Components](https://s3.us-east-2.amazonaws.com/bright-components/bc_large.png "Bright Components")

Responders are a great way to make your controllers slim and keep the code related to responses in one place. The general idea is based on the "R" in [ADR - Action Domain Responder](http://paul-m-jones.com/archives/5970), by [Paul M. Jones](https://twitter.com/pmjones).

For example, in your controller:

```php
namespace App\Http\Controllers;

use App\MyDatasource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responders\Post\IndexResponder;

class PostIndex implements Controller
{
    /**
     * The Responder.
     *
     * @var \App\Http\Responders\Post\IndexResponder
     */
    private $responder;

    /**
     * Construct a new PostIndex Controller.
     *
     * @param \App\Http\Responders\Post\IndexResponder $responder
     */
    public function __construct(Responder $responder)
    {
        $this->responder = $responder;
    }

    public function index(Request $request)
    {
        $data = MyDatasource::getSomeData($request);

        return $this->responder->respond($request, $data);
    }
}
```

Then in your responder:

```php
namespace App\Http\Responders\Post;

use Illuminate\Http\Request;
use BrightComponents\Responder\Responder;

class IndexResponder extends Responder
{
    /**
     * Send a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|array|null  $data
     *
     * @return mixed
     */
    public function respond(Request $request, $data = null)
    {
        if ($request->isApi()) {
            // return json
        }

        return $this->view('posts.index', ['posts' => $data]);
    }
}

```

The benefit over the traditional "handle the response inside your controller actions", is the clarity it brings, the narrow class responsibility, fewer dependencies in your controller and overall organization. When used together with [single action controllers](https://laravel.com/docs/5.6/controllers#single-action-controllers), you can really clean up your controllers and bring a lot of clarity to your codebase.

## Installation

You can install the package via composer:

```bash
composer require bright-components/responders
```
Laravel versions > 5.6.0 will automatically identify and register the service provider.

Then, run:
```bash
php artisan vendor:publish
```
and choose the BrightComponents/Responders option.

This will copy the package configuration (responders.php) to your 'config' folder.
Here, you can set the root namespace for your Responder classes:

```php
return [

    /*
    |--------------------------------------------------------------------------
    | Namespace
    |--------------------------------------------------------------------------
    |
    | Set the namespace for the Responders.
    |
 */

    'namespace' => 'Http\\Responders'
];
```

## Usage

To begin using BrightComponents/Responders, simply follow the instructions above, then generate your Responder classes as needed.
To generate an IndexResponder for Posts, as in the example above, enter the following command into your terminal:

```bash
php artisan make:responder Post\\IndexResponder
```

Then add the responder as a dependency to your controller and call the ```respond``` method. This method expects an instance of ```Illuminate\Http\Request``` and an optional $data object:

```php
public function index(Request $request)
{
    $data = MyDatasource::getSomeData();

    return $this->responder->respond($request, $data)
}
```

The abstract responder, that your responders extend, has a few 'helper' methods for working with responses:
```php
    protected function view($view, $data = [], $mergeData = []);

    protected function redirect(string $path = null, $status = 302, array $headers = [], $secure = null);

    protected function flash($message, array $options = []); //uses DevMarketer/LaraFlash

    protected function json($content = '', $status = 500, array $headers = []);
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email clay@phpstage.com instead of using the issue tracker.

## Roadmap

We plan to work on flexibility/configuration soon, as well as release a framework agnostic version of the package.

## Credits

- [Clayton Stone](https://github.com/devcircus)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
