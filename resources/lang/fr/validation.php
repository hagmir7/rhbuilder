<?php


return [
    'accepted'             => 'Le champ :attribute doit être accepté.',
    'active_url'           => 'Le champ :attribute n\'est pas une URL valide.',
    'after'                => 'Le champ :attribute doit être une date postérieure au :date.',
    'after_or_equal'       => 'Le champ :attribute doit être une date postérieure ou égale à :date.',
    'alpha'                => 'Le champ :attribute ne peut contenir que des lettres.',
    'alpha_dash'           => 'Le champ :attribute ne peut contenir que des lettres, des chiffres et des tirets.',
    'alpha_num'            => 'Le champ :attribute ne peut contenir que des lettres et des chiffres.',
    'array'                => 'Le champ :attribute doit être un tableau.',
    'before'               => 'Le champ :attribute doit être une date antérieure au :date.',
    'before_or_equal'      => 'Le champ :attribute doit être une date antérieure ou égale à :date.',
    'between'              => [
        'numeric' => 'Le champ :attribute doit être compris entre :min et :max.',
        'file'    => 'Le champ :attribute doit être compris entre :min et :max kilo-octets.',
        'string'  => 'Le champ :attribute doit être compris entre :min et :max caractères.',
        'array'   => 'Le champ :attribute doit avoir entre :min et :max éléments.',
    ],
    'boolean'              => 'Le champ :attribute doit être vrai ou faux.',
    'confirmed'            => 'Le champ :attribute de confirmation ne correspond pas.',
    'date'                 => 'Le champ :attribute n\'est pas une date valide.',
    'date_equals'          => 'Le champ :attribute doit être une date égale à :date.',
    'date_format'          => 'Le champ :attribute ne correspond pas au format :format.',
    'different'            => 'Les champs :attribute et :other doivent être différents.',
    'digits'               => 'Le champ :attribute doit être :digits chiffres.',
    'digits_between'       => 'Le champ :attribute doit être compris entre :min et :max chiffres.',
    'dimensions'           => 'Le champ :attribute a des dimensions d\'image non valides.',
    'distinct'             => 'Le champ :attribute a une valeur en double.',
    'email'                => 'Le champ :attribute doit être une adresse e-mail valide.',
    'ends_with'            => 'Le champ :attribute doit se terminer par une des valeurs suivantes: :values.',
    'exists'               => 'Le champ :attribute sélectionné est invalide.',
    'file'                 => 'Le champ :attribute doit être un fichier.',
    'filled'               => 'Le champ :attribute doit avoir une valeur.',
    'gt'                   => [
        'numeric' => 'Le champ :attribute doit être supérieur à :value.',
        'file'    => 'Le champ :attribute doit être supérieur à :value kilo-octets.',
        'string'  => 'Le champ :attribute doit être supérieur à :value caractères.',
        'array'   => 'Le champ :attribute doit avoir plus de :value éléments.',
    ],
    'gte'                  => [
        'numeric' => 'Le champ :attribute doit être supérieur ou égal à :value.',
        'file'    => 'Le champ :attribute doit être supérieur ou égal à :value kilo-octets.',
        'string'  => 'Le champ :attribute doit être supérieur ou égal à :value caractères.',
        'array'   => 'Le champ :attribute doit avoir :value éléments ou plus.',
    ],
    'image'                => 'Le champ :attribute doit être une image.',
    'in'                   => 'Le champ :attribute sélectionné est invalide.',
    'in_array'             => 'Le champ :attribute n\'existe pas dans :other.',
    'integer'              => 'Le champ :attribute doit être un entier.',
    'ip'                   => 'Le champ :attribute doit être une adresse IP valide.',
    'ipv4'                 => 'Le champ :attribute doit être une adresse IPv4 valide.',
    'ipv6'                 => 'Le champ :attribute doit être une adresse IPv6 valide.',
    'json'                 => 'Le champ :attribute doit être une chaîne JSON valide.',
    'lt'                   => [
        'numeric' => 'Le champ :attribute doit être inférieur à :value.',
        'file'    => 'Le champ :attribute doit être inférieur à :value kilo-octets.',
        'string'  => 'Le champ :attribute doit être inférieur à :value caractères.',
        'array'   => 'Le champ :attribute doit avoir moins de :value éléments.',
    ],
    'lte'                  => [
        'numeric' => 'Le champ :attribute doit être inférieur ou égal à :value.',
        'file'    => 'Le champ :attribute doit être inférieur ou égal à :value kilo-octets.',
        'string'  => 'Le champ :attribute doit être inférieur ou égal à :value caractères.',
        'array'   => 'Le champ :attribute ne doit pas avoir plus de :value éléments.',
    ],
    'max'                  => [
        'numeric' => 'Le champ :attribute ne peut pas être supérieur à :max.',
        'file'    => 'Le champ :attribute ne peut pas être supérieur à :max kilo-octets.',
        'string'  => 'Le champ :attribute ne peut pas être supérieur à :max caractères.',
        'array'   => 'Le champ :attribute ne peut pas avoir plus de :max éléments.',
    ],
    'mimes'                => 'Le champ :attribute doit être un fichier de type :values.',
    'mimetypes'            => 'Le champ :attribute doit être un fichier de type :values.',
    'min'                  => [
        'numeric' => 'Le champ :attribute doit être au moins de :min.',
        'file'    => 'Le champ :attribute doit être au moins de :min kilo-octets.',
        'string'  => 'Le champ :attribute doit être au moins de :min caractères.',
        'array'   => 'Le champ :attribute doit avoir au moins :min éléments.',
    ],
    'not_in'               => 'Le champ :attribute sélectionné est invalide.',
    'not_regex'            => 'Le format du champ :attribute est invalide.',
    'numeric'              => 'Le champ :attribute doit être un nombre.',
    'password'             => 'Le mot de passe est incorrect.',
    'present'              => 'Le champ :attribute doit être présent.',
    'regex'                => 'Le format du champ :attribute est invalide.',
    'required'             => 'Le champ :attribute est requis.',
    'required_if'          => 'Le champ :attribute est requis lorsque :other est :value.',
    'required_unless'      => 'Le champ :attribute est requis sauf si :other est dans :values.',
    'required_with'        => 'Le champ :attribute est requis lorsque :values est présent.',
    'required_with_all'    => 'Le champ :attribute est requis lorsque :values est présent.',
    'required_without'     => 'Le champ :attribute est requis lorsque :values n\'est pas présent.',
    'required_without_all' => 'Le champ :attribute est requis lorsque aucun de :values n\'est présent.',
    'same'                 => 'Les champs :attribute et :other doivent correspondre.',
    'size'                 => [
        'numeric' => 'Le champ :attribute doit être :size.',
        'file'    => 'Le champ :attribute doit être de :size kilo-octets.',
        'string'  => 'Le champ :attribute doit être de :size caractères.',
        'array'   => 'Le champ :attribute doit contenir :size éléments.',
    ],
    'starts_with'          => 'Le champ :attribute doit commencer par une des valeurs suivantes : :values.',
    'string'               => 'Le champ :attribute doit être une chaîne de caractères.',
    'timezone'             => 'Le champ :attribute doit être une zone valide.',
    'unique'               => 'La valeur du champ :attribute est déjà utilisée.',
    'uploaded'             => 'Le champ :attribute n\'a pas pu être téléchargé.',
    'url'                  => 'Le format de l\'URL de :attribute n\'est pas valide.',
    'uuid'                 => 'Le champ :attribute doit être un UUID valide.',
    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'message personnalisé',
        ],
    ],
    'passwords'            => [
        'reset' => 'Votre mot de passe a été réinitialisé !',
        'sent' => 'Nous vous avons envoyé par email le lien de réinitialisation de mot de passe !',
        'throttled' => 'Veuillez patienter avant de réessayer.',
        'token' => 'Ce jeton de réinitialisation de mot de passe est invalide.',
        'user' => "Nous ne trouvons aucun utilisateur avec cette adresse email.",
    ],
    'attributes'           => [],

];
