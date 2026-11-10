<?php

/*
|--------------------------------------------------------------------------
| Messages de validation en français
|--------------------------------------------------------------------------
| Laravel cherche d'abord la clé dans ce fichier ; si elle manque, il
| utilise le fichier anglais (APP_FALLBACK_LOCALE). On couvre ici toutes
| les règles utilisées par les formulaires d'Ilmify.
*/

return [

    'accepted' => 'Le champ :attribute doit être accepté.',
    'after' => 'Le champ :attribute doit être une date postérieure au :date.',
    'alpha' => 'Le champ :attribute ne peut contenir que des lettres.',
    'alpha_dash' => 'Le champ :attribute ne peut contenir que des lettres, des chiffres et des tirets.',
    'alpha_num' => 'Le champ :attribute ne peut contenir que des lettres et des chiffres.',
    'array' => 'Le champ :attribute doit être une liste.',
    'before' => 'Le champ :attribute doit être une date antérieure au :date.',
    'boolean' => 'Le champ :attribute doit être vrai ou faux.',
    'confirmed' => 'La confirmation du champ :attribute ne correspond pas.',
    'current_password' => 'Le mot de passe actuel est incorrect.',
    'date' => 'Le champ :attribute doit être une date valide.',
    'different' => 'Les champs :attribute et :other doivent être différents.',
    'email' => 'Le champ :attribute doit être une adresse e-mail valide.',
    'exists' => 'La valeur sélectionnée dans :attribute est invalide.',
    'image' => 'Le champ :attribute doit être une image.',
    'in' => 'La valeur sélectionnée dans :attribute est invalide.',
    'integer' => 'Le champ :attribute doit être un nombre entier.',
    'mimes' => 'Le champ :attribute doit être un fichier de type : :values.',
    'not_in' => 'La valeur sélectionnée dans :attribute est invalide.',
    'numeric' => 'Le champ :attribute doit être un nombre.',
    'password' => [
        'letters' => 'Le mot de passe doit contenir au moins une lettre.',
        'mixed' => 'Le mot de passe doit contenir au moins une majuscule et une minuscule.',
        'numbers' => 'Le mot de passe doit contenir au moins un chiffre.',
        'symbols' => 'Le mot de passe doit contenir au moins un caractère spécial.',
        'uncompromised' => 'Ce mot de passe est apparu dans une fuite de données. Choisis-en un autre.',
    ],
    'required' => 'Le champ :attribute est obligatoire.',
    'required_if' => 'Le champ :attribute est obligatoire quand :other vaut :value.',
    'same' => 'Les champs :attribute et :other doivent être identiques.',
    'string' => 'Le champ :attribute doit être un texte.',
    'unique' => 'Cette valeur de :attribute est déjà utilisée.',
    'uploaded' => "Le fichier :attribute n'a pas pu être envoyé.",
    'url' => 'Le champ :attribute doit être une adresse valide.',

    'size' => [
        'array' => 'Le champ :attribute doit contenir :size éléments.',
        'file' => 'Le fichier :attribute doit peser :size kilo-octets.',
        'numeric' => 'Le champ :attribute doit être égal à :size.',
        'string' => 'Le champ :attribute doit contenir :size caractères.',
    ],

    'between' => [
        'array' => 'Le champ :attribute doit contenir entre :min et :max éléments.',
        'file' => 'Le fichier :attribute doit peser entre :min et :max kilo-octets.',
        'numeric' => 'Le champ :attribute doit être compris entre :min et :max.',
        'string' => 'Le champ :attribute doit contenir entre :min et :max caractères.',
    ],

    'max' => [
        'array' => 'Le champ :attribute ne peut pas contenir plus de :max éléments.',
        'file' => 'Le fichier :attribute ne peut pas dépasser :max kilo-octets.',
        'numeric' => 'Le champ :attribute ne peut pas être supérieur à :max.',
        'string' => 'Le champ :attribute ne peut pas dépasser :max caractères.',
    ],

    'min' => [
        'array' => 'Le champ :attribute doit contenir au moins :min éléments.',
        'file' => 'Le fichier :attribute doit peser au moins :min kilo-octets.',
        'numeric' => 'Le champ :attribute doit être supérieur ou égal à :min.',
        'string' => 'Le champ :attribute doit contenir au moins :min caractères.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Noms lisibles des champs
    |--------------------------------------------------------------------------
    | Ainsi le message parle de « adresse e-mail » et non de « email ».
    */

    'attributes' => [
        'name' => 'nom',
        'email' => 'adresse e-mail',
        'password' => 'mot de passe',
        'password_confirmation' => 'confirmation du mot de passe',
        'subject_id' => 'matière',
        'chapter_id' => 'chapitre',
        'quiz_id' => 'quiz',
        'question_id' => 'question',
        'title' => 'titre',
        'content' => 'contenu',
        'description' => 'description',
        'color' => 'couleur',
        'position' => 'position',
        'passing_score' => 'score de réussite',
        'explanation' => 'explication',
        'points' => 'points',
        'is_correct' => 'bonne réponse',
        'is_published' => 'publication',
        'is_active' => 'compte actif',
        'role' => 'rôle',
    ],

];
