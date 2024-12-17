<?php

return [
    'show_custom_fields' => true,
    'custom_fields' => [
        'custom_field_1' => [
            'type' => 'text',
            'label' => 'Matrícula',
            'placeholder' => 'Matrícula',
            'required' => true,
            'rules' => 'required|numeric|digits:9',
        ],
        'custom_field_2' => [
            'type' => 'text',
            'label' => 'Documento',
            'placeholder' => 'Documento (CPF ou DI)',
            'required' => true,
            'rules' => 'required|numeric|digits_between:7,11',
        ],
        'custom_field_3' => [
            'type' => 'select', // checkbox
            'label' => 'Disciplina Pricipal',
            'placeholder' => 'Disciplina Pricipal',
            'required' => false,
            'options' => [
                'option_1' => 'Química',
                'option_2' => 'Física',
                'option_3' => 'Matemática',
                'option_4' => 'Português',
                'option_5' => 'História',
                'option_6' => 'Geografia',
                'option_7' => 'Ciências',
                'option_8' => 'Educação Física',
                'option_9' => 'Inglês',
                'option_10' => 'Sociologia',
            ],
        ],
        'custom_field_4' => [
            'type' =>'textarea',
            'label' => 'Descrição',
            'placeholder' => 'Descrição',
            'rows' => '3',
            'required' => false,
        ],
        'custom_field_5' => [
            'type' => 'datetime',
            'label' => 'Data de Nascimento',
            'placeholder' => 'Data de Nascimento',
            'seconds' => false,
        ],
        'custom_field_6' => [
            'type' => 'boolean',
            'label' => 'Ativo',
            'placeholder' => 'Boolean'
        ],
    ]
];
