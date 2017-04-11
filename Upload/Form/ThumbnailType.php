<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 4/10/17
 * Time: 1:19 PM
 */

namespace Xiranst\Bundle\MediaBundle\Upload\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Xiranst\Bundle\MediaBundle\EventSubscriber\ThumbnailEventSubscriber;
use Xiranst\Bundle\MediaBundle\Upload\Form\DataTransformer\FileToObjectTransformer;
use Xiranst\Bundle\MediaBundle\Upload\Service\UploadService;

class ThumbnailType extends AbstractType
{
    private $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService    = $uploadService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventSubscriber(new ThumbnailEventSubscriber($this->uploadService));
        $transformer = new FileToObjectTransformer();
        $builder->addModelTransformer($transformer);
    }

    public function buildView(FormView $view, FormInterface $form, array $options) {}

    public function getParent()
    {
        return FileType::class;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(array(
            'invalid_message' => 'The uploaded file does not exist',
        ));
    }
}