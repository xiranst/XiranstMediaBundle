# XiranstMediaBundle
Help your application to upload file easier.

### Add XirantMediaBundle as a dependency of your application via composer

```
$ composer require xiranst/media-bundle:dev-master
```

### Add XirantMediaBundle to your application kernel.

```php
// app/AppKernel.php
<?php
    // ...
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Xiranst\Bundle\MediaBundle\XirantMediaBundle(),
        );
    }