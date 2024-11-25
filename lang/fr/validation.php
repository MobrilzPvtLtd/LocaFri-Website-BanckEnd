<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

   'accepted' => ':attribute doit être accepté.',
'active_url' => ':attribute n\'est pas une URL valide.',
'after' => ':attribute doit être une date postérieure au :date.',
'after_or_equal' => ':attribute doit être une date postérieure ou égale au :date.',
'alpha' => ':attribute ne peut contenir que des lettres.',
'alpha_dash' => ':attribute ne peut contenir que des lettres, des chiffres, des tirets et des underscores.',
'alpha_num' => ':attribute ne peut contenir que des lettres et des chiffres.',
'array' => ':attribute doit être un tableau.',
'before' => ':attribute doit être une date antérieure au :date.',
'before_or_equal' => ':attribute doit être une date antérieure ou égale au :date.',
'between' => [
    'numeric' => ':attribute doit être entre :min et :max.',
    'file' => ':attribute doit être entre :min et :max kilo-octets.',
    'string' => ':attribute doit contenir entre :min et :max caractères.',
    'array' => ':attribute doit avoir entre :min et :max éléments.',
],
'boolean' => 'Le champ :attribute doit être vrai ou faux.',
'confirmed' => 'La confirmation de :attribute ne correspond pas.',
'date' => ':attribute n\'est pas une date valide.',
'date_equals' => ':attribute doit être une date égale à :date.',
'date_format' => ':attribute ne correspond pas au format :format.',
'different' => ':attribute et :other doivent être différents.',
'digits' => ':attribute doit contenir :digits chiffres.',
'digits_between' => ':attribute doit contenir entre :min et :max chiffres.',
'dimensions' => 'Les dimensions de l\'image :attribute ne sont pas valides.',
'distinct' => 'Le champ :attribute a une valeur en double.',
'email' => ':attribute doit être une adresse email valide.',
'ends_with' => ':attribute doit se terminer par l\'un des éléments suivants : :values',
'exists' => 'Le :attribute sélectionné est invalide.',
'file' => ':attribute doit être un fichier.',
'filled' => 'Le champ :attribute doit avoir une valeur.',
'gt' => [
    'numeric' => ':attribute doit être supérieur à :value.',
    'file' => ':attribute doit être supérieur à :value kilo-octets.',
    'string' => ':attribute doit contenir plus de :value caractères.',
    'array' => ':attribute doit avoir plus de :value éléments.',
],
'gte' => [
    'numeric' => ':attribute doit être supérieur ou égal à :value.',
    'file' => ':attribute doit être supérieur ou égal à :value kilo-octets.',
    'string' => ':attribute doit contenir au moins :value caractères.',
    'array' => ':attribute doit avoir au moins :value éléments.',
],
'image' => ':attribute doit être une image.',
'in' => ':attribute sélectionné est invalide.',
'in_array' => ':attribute n\'existe pas dans :other.',
'integer' => ':attribute doit être un entier.',
'ip' => ':attribute doit être une adresse IP valide.',
'ipv4' => ':attribute doit être une adresse IPv4 valide.',
'ipv6' => ':attribute doit être une adresse IPv6 valide.',
'json' => ':attribute doit être une chaîne JSON valide.',
'lt' => [
    'numeric' => ':attribute doit être inférieur à :value.',
    'file' => ':attribute doit être inférieur à :value kilo-octets.',
    'string' => ':attribute doit contenir moins de :value caractères.',
    'array' => ':attribute doit avoir moins de :value éléments.',
],
'lte' => [
    'numeric' => ':attribute doit être inférieur ou égal à :value.',
    'file' => ':attribute doit être inférieur ou égal à :value kilo-octets.',
    'string' => ':attribute doit contenir au plus :value caractères.',
    'array' => ':attribute ne doit pas contenir plus de :value éléments.',
],
'max' => [
    'numeric' => ':attribute ne peut pas être supérieur à :max.',
    'file' => ':attribute ne peut pas dépasser :max kilo-octets.',
    'string' => ':attribute ne peut pas contenir plus de :max caractères.',
    'array' => ':attribute ne peut pas contenir plus de :max éléments.',
],
'mimes' => ':attribute doit être un fichier de type : :values.',
'mimetypes' => ':attribute doit être un fichier de type : :values.',
'min' => [
    'numeric' => ':attribute doit être au moins de :min.',
    'file' => ':attribute doit être au moins de :min kilo-octets.',
    'string' => ':attribute doit contenir au moins :min caractères.',
    'array' => ':attribute doit contenir au moins :min éléments.',
],
'multiple_of' => ':attribute doit être un multiple de :value.',
'not_in' => ':attribute sélectionné est invalide.',
'not_regex' => 'Le format de :attribute est invalide.',
'numeric' => ':attribute doit être un nombre.',
'password' => 'Le mot de passe est incorrect.',
'present' => 'Le champ :attribute doit être présent.',
'regex' => 'Le format de :attribute est invalide.',
'required' => 'Le champ :attribute est obligatoire.',
'required_if' => 'Le champ :attribute est obligatoire lorsque :other est :value.',
'required_unless' => 'Le champ :attribute est obligatoire sauf si :other est dans :values.',
'required_with' => 'Le champ :attribute est obligatoire lorsque :values est présent.',
'required_with_all' => 'Le champ :attribute est obligatoire lorsque :values sont présents.',
'required_without' => 'Le champ :attribute est obligatoire lorsque :values n\'est pas présent.',
'required_without_all' => 'Le champ :attribute est obligatoire lorsque aucun de :values n\'est présent.',
'same' => ':attribute et :other doivent correspondre.',
'size' => [
    'numeric' => ':attribute doit être :size.',
    'file' => ':attribute doit être de :size kilo-octets.',
    'string' => ':attribute doit contenir :size caractères.',
    'array' => ':attribute doit contenir :size éléments.',
],
'starts_with' => ':attribute doit commencer par l\'un des éléments suivants : :values',
'string' => ':attribute doit être une chaîne de caractères.',
'timezone' => ':attribute doit être un fuseau horaire valide.',
'unique' => ':attribute a déjà été pris.',
'uploaded' => ':attribute n\'a pas pu être téléchargé.',
'url' => 'Le format de :attribute est invalide.',
'uuid' => ':attribute doit être un UUID valide.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
    'name' => 'nom',
    'username' => 'nom d’utilisateur',
    'email' => 'email',
    'first_name' => 'prénom',
    'last_name' => 'nom de famille',
    'password' => 'mot de passe',
    'password_confirmation' => 'confirmation du mot de passe',
    'city' => 'ville',
    'country' => 'pays',
    'address' => 'adresse',
    'phone' => 'téléphone fixe',
    'mobile' => 'téléphone portable',
    'age' => 'âge',
    'sex' => 'sexe',
    'gender' => 'genre',
    'day' => 'jour',
    'month' => 'mois',
    'year' => 'année',
    'hour' => 'heure',
    'minute' => 'minute',
    'second' => 'seconde',
    'title' => 'titre',
    'text' => 'texte',
    'content' => 'contenu',
    'description' => 'description',
    'excerpt' => 'extrait',
    'date' => 'date',
    'time' => 'heure',
    'available' => 'disponible',
    'size' => 'taille',
    'terms' => 'conditions',
    'province' => 'province',


    ],
];
