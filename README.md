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
    
```
the default directory of uploaded files is 
 ```
    %kernel.root_dir%/../web/media
```

if you need to change this path, please add this configuration in config.yml

```
xiranst_media:
    upload_directory: '%kernel.root_dir%/../web/media'
```