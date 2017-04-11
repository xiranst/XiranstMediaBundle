# XiranstMediaBundle
Help your application to upload file easier.

#### 1, Installation with composer

```
$ composer require xiranst/media-bundle:dev-master
```

#### 2, Enable in AppKernel.php

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
#### 3, Usage in Form Type

```
<?php 
// src/Xiranst/Bundle/DemoBundle/Form/YourFormType.php

namespace Xiranst\Bundle\DemoBundle\Form;

use Xiranst\Bundle\MediaBundle\Form\ThumbnailType;
class YourFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    // ...
        $builder->add('thumbnail', ThumbnailType::class);
        // ...
    }
    // ...
}
```

#### 4, Options: Configure the upload directory in config.yml

Default directory is:

```
%kernel.root_dir%/../web/uploads/media
```

Please make the permission of web/uploads/media directory is 0777;

If you need to change this path, please add this configuration in config.yml

    // config.yml
    xiranst_media:
    	upload_directory: '%kernel.root_dir%/../your-directory/'