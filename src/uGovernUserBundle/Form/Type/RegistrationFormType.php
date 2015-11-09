<?php 

namespace uGovernUserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('party', 'choice', array(
                'choices' => array(
                    'Independant' => 'Indepedant',
                    'Democrat' => 'Democrat',
                    'Republican' => 'Republican',
                    'Other' => 'Other'
                )
            )
        );
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'ugovern_user_registration';
    }
}

?>