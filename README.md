<p align="center"><a href="https://wood.veskod.com/documentation/admin-panel" target="_blank">
<img src="https://wood.veskod.com/images/logo.png" alt="Laravel Logo">
</a></p>

<p align="center">
<a href="https://packagist.org/packages/bfg/admin-audit"><img src="https://img.shields.io/packagist/dt/bfg/admin-audit" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/bfg/admin-audit"><img src="https://img.shields.io/packagist/v/bfg/admin-audit" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/bfg/admin-audit"><img src="https://img.shields.io/packagist/l/bfg/admin-audit" alt="License"></a>
</p>

# Install
```
composer require bfg/admin-audit
```
# Admin install
```
php artisan admin:extension bfg/admin-audit --install
```
# Setup auditing
For more information on how to use the package, please refer to our 
official documentation available on [laravel-auditing.com](https://laravel-auditing.com/) or in the 
[repository](https://github.com/owen-it/laravel-auditing-doc/blob/main/documentation.md) documentation file. 
Our documentation provides detailed instructions on how to install and use the package, as well as examples 
and best practices for auditing in Laravel applications.

## Publish configs
```
php artisan vendor:publish --provider "OwenIt\Auditing\AuditingServiceProvider" --tag="config"
```
## Publish migrations
```
php artisan vendor:publish --provider "OwenIt\Auditing\AuditingServiceProvider" --tag="migrations"
```
## Migrate
```php
php artisan migrate
```
## Enable console audit
Open `configs/audit.php` and enable `console` config:
```php
...
   /*
    |--------------------------------------------------------------------------
    | Audit Console
    |--------------------------------------------------------------------------
    |
    | Whether console events should be audited (eg. php artisan db:seed).
    |
    */

    'console' => true,
...
```
## Add audit to model
Add implement
```php
use OwenIt\Auditing\Contracts\Auditable;
...
class User extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    ...
}
```
