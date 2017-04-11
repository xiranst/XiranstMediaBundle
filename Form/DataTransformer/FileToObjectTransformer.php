<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 4/10/17
 * Time: 2:13 PM
 */

namespace Xiranst\Bundle\MediaBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\File\File;

class FileToObjectTransformer implements DataTransformerInterface
{
    /**
     * Transforms an object (file) to a string (fileName).
     *
     * @param  File|null $file
     * @return string
     */
    public function transform($file) {}

    /**
     * Transforms a string (fileName) to an object (file).
     *
     * @param  string $fileName
     * @return File|null
     * @throws TransformationFailedException if object (file) is not found.
     */
    public function reverseTransform($file) {}
}