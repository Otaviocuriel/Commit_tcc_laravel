<?php

return [
    'accepted' => 'O campo :attribute deve ser aceito.',
    'active_url' => 'O campo :attribute não é uma URL válida.',
    'after' => 'O campo :attribute deve ser uma data após :date.',
    'alpha' => 'O campo :attribute deve conter apenas letras.',
    'alpha_dash' => 'O campo :attribute deve conter apenas letras, números, traços e sublinhados.',
    'alpha_num' => 'O campo :attribute deve conter apenas letras e números.',
    'array' => 'O campo :attribute deve ser um array.',
    'before' => 'O campo :attribute deve ser uma data antes de :date.',
    'between' => [
        'numeric' => 'O campo :attribute deve estar entre :min e :max.',
        'file' => 'O arquivo :attribute deve ter entre :min e :max kilobytes.',
        'string' => 'O campo :attribute deve ter entre :min e :max caracteres.',
        'array' => 'O campo :attribute deve ter entre :min e :max itens.',
    ],
    'boolean' => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed' => 'A confirmação do campo :attribute não coincide.',
    'date' => 'O campo :attribute não é uma data válida.',
    'date_format' => 'O campo :attribute deve estar no formato :format.',
    'different' => 'Os campos :attribute e :other devem ser diferentes.',
    'digits' => 'O campo :attribute deve ter :digits dígitos.',
    'digits_between' => 'O campo :attribute deve ter entre :min e :max dígitos.',
    'email' => 'O campo :attribute deve ser um endereço de e-mail válido.',
    'exists' => 'O campo :attribute selecionado é inválido.',
    'filled' => 'O campo :attribute é obrigatório.',
    'image' => 'O campo :attribute deve ser uma imagem.',
    'in' => 'O campo :attribute selecionado é inválido.',
    'integer' => 'O campo :attribute deve ser um número inteiro.',
    'ip' => 'O campo :attribute deve ser um endereço de IP válido.',
    'json' => 'O campo :attribute deve ser uma string JSON válida.',
    'max' => [
        'numeric' => 'O campo :attribute não pode ser maior que :max.',
        'file' => 'O arquivo :attribute não pode ser maior que :max kilobytes.',
        'string' => 'O campo :attribute não pode ter mais que :max caracteres.',
        'array' => 'O campo :attribute não pode ter mais que :max itens.',
    ],
    'mimes' => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'min' => [
        'numeric' => 'O campo :attribute deve ser pelo menos :min.',
        'file' => 'O arquivo :attribute deve ter pelo menos :min kilobytes.',
        'string' => 'O campo :attribute deve ter pelo menos :min caracteres.',
        'array' => 'O campo :attribute deve ter pelo menos :min itens.',
    ],
    'not_in' => 'O campo :attribute selecionado é inválido.',
    'numeric' => 'O campo :attribute deve ser um número.',
    'regex' => 'O formato do campo :attribute é inválido.',
    'required' => 'O campo :attribute é obrigatório.',
    'required_if' => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_unless' => 'O campo :attribute é obrigatório a menos que :other esteja em :values.',
    'required_with' => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all' => 'O campo :attribute é obrigatório quando :values estão presentes.',
    'required_without' => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values estão presentes.',
    'same' => 'Os campos :attribute e :other devem ser iguais.',
    'size' => [
        'numeric' => 'O campo :attribute deve ser :size.',
        'file' => 'O arquivo :attribute deve ter :size kilobytes.',
        'string' => 'O campo :attribute deve ter :size caracteres.',
        'array' => 'O campo :attribute deve conter :size itens.',
    ],
    'string' => 'O campo :attribute deve ser uma string.',
    'timezone' => 'O campo :attribute deve ser uma zona válida.',
    'unique' => 'O campo :attribute já está sendo usado.',
    'uploaded' => 'O arquivo :attribute falhou ao fazer upload.',
    'url' => 'O formato da URL :attribute é inválido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Aqui você pode definir suas próprias mensagens de validação personalizadas.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'Mensagem personalizada',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Validation Attributes
    |--------------------------------------------------------------------------
    |
    | Aqui você pode trocar os rótulos dos atributos para algo mais amigável.
    |
    */

    'attributes' => [
        'email' => 'e-mail',
        'cpf' => 'CPF',
        'telefone' => 'telefone',
    ],
];