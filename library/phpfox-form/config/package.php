<?php

namespace Phpfox\Form;

return [
    'form.renders'  => [
        'input'          => InputRender::class,
        'form_bootstrap' => FormBootstrapRender::class,
        'button'         => ButtonRender::class,
        'checkbox'       => CheckboxRender::class,
        'select'         => SelectRender::class,
        'radio'          => RadioRender::class,
        'file_upload'    => FileUploadRender::class,
        'textarea'       => TextareaRender::class,
        'yesno'          => YesnoRender::class,
    ],
    'form.elements' => [
        'color_picker' => ColorPicker::class,
        'editor'       => Textarea::class,
        'choice'       => Choice::class,
        'checkbox'     => Checkbox::class,
        'select_multi' => MultiChoice::class,
        'button'       => Button::class,
        'static'       => StaticText::class,
        'file'         => InputFile::class,
        'text'         => Text::class,
        'textarea'     => Textarea::class,
        'form'         => Form::class,
    ],
    'services'      => [
        'form.render'  => [null, FormFacades::class],
        'form.factory' => [null, FormFactory::class],
    ],
];
