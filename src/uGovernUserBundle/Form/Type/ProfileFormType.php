<?php 

namespace uGovernUserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileFormType extends AbstractType
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
        )
        ->add('birthday', 'date', array(
            'input'  => 'datetime',
            'widget' => 'choice',
            'years' => range(date('Y') - 100, date('Y') - 18),
        ))
        ->add('education', 'choice', array(
            'choices' => array(
                'High School' => 'High School',
                'College Degree' => 'College Degree',
                'etc' => 'etc'
            )
        ))
        ->add('occupation', 'text')
        ->add('location', 'text')
        ->add('gender', 'choice', array(
            'choices' => array(
                'Male' => 'Male',
                'Female' => 'Female',
                'Other' => 'Other'
            )
        ))
        ->add('ethnicity', 'choice', array(
            'choices' => array(
                'American Indian or Alaska Native' => 'American Indian or Alaska Native', 
                'Asian' => 'Asian', 
                'Black or African American' => 'Black or African American', 
                'Hispanic or Latino' => 'Hispanic or Latino', 
                'Native Hawaiian or Other Pacific Islander' => 'Native Hawaiian or Other Pacific Islander', 
                'White' => 'White'
            )
        ))
        ->add('registeredVoter', 'choice', array(
            'choices' => array(
                'Yes' => 'Yes',
                'No' => 'No'
            )
        ));
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'ugovern_user_profile';
    }
}

?>