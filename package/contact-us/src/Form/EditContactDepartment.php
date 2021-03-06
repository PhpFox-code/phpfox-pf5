<?php

namespace Neutron\ContactUs\Form;


use Phpfox\Form\Form;

class EditContactDepartment extends Form
{
    protected function initialize()
    {
        $this->addElements([
            [
                'name'       => 'name',
                'label'      => _text('Department Name', 'contact-us'),
                'factory'    => 'text',
                'required'   => true,
                'attributes' => [
                    'class'       => 'form-control',
                    'maxlength'   => 50,
                    'placeholder' => 'Department Name',
                ],
            ],
            [
                'name'       => 'email',
                'label'      => _text('Department Email', 'contact-us'),
                'factory'    => 'text',
                'required'   => true,
                'attributes' => [
                    'class'       => 'form-control',
                    'maxlength'   => 50,
                    'placeholder' => 'info@example.com',
                ],
            ],
            [
                'name'     => 'is_active',
                'label'    => _text('Active', 'contact-us'),
                'factory'  => 'choice',
                'render'   => 'yesno',
                'required' => true,
                'value'    => 1,
            ],
        ]);
    }
}