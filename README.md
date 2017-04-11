# XiranstMediaBundle
Help your application to upload file easier.

Usage

	composer require xiranst/media-bundle:dev-master

app/AppKernel.php

	class AppKernel extends Kernel
	{
	    public function registerBundles()
	    {
	        $bundles = array(
	            // ...
	
	            new Xiranst\Bundle\MediaBundle\XiranstMediaBundle(),
	        );
	    }
	}
