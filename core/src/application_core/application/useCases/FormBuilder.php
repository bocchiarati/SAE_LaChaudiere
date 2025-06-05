<?php

namespace App\application_core\application\useCases;

use App\application_core\application\useCases\interfaces\FormBuilderInterface;
use App\webui\providers\interfaces\CsrfTokenProviderInterface;

class FormBuilder implements FormBuilderInterface {
    private CsrfTokenProviderInterface $csrfTokenProvider;
    public function __construct(CsrfTokenProviderInterface $csrfTokenProvider) {
        $this->csrfTokenProvider = $csrfTokenProvider;
    }

    public function buildSignInForm(): array {
        return [
            'actionRoute' => 'post_signin',
            'submit_button' => "Se connecter",
            'links' => [
                [
                    "label" => "Pas encore de compte ? Créez en un dès maintenant !",
                    "route" => "creer_compte"
                ]
            ],
            'inputs' => [
                [
                    'name' => 'email',
                    'label' => 'Email',
                    'type' => 'text',
                    'placeholder' => 'exemple@mail.com',
                    'required' => true
                ],
                [
                    'name' => 'password',
                    'label' => 'Mot de passe',
                    'type' => 'password',
                    'placeholder' => 'Renseigner votre mot de passe',
                    "required" => true,
                ]
            ],
            'selects' => [],
            'csrf_token' => $this->csrfTokenProvider->generate()
        ];
    }

    public function buildRegisterForm(): array {
        return [
            'actionRoute' => 'post_creer_compte',
            'submit_button' => "S'enregistrer",
            'links' => [
                [
                    "label" => "Déjà un compte ? Connectez vous dès maintenant !",
                    "route" => "signin"
                ]
            ],
            'inputs' => [
                [
                    'name' => 'email',
                    'label' => 'Email',
                    'type' => 'text',
                    'placeholder' => 'exemple@mail.com',
                    'required' => true
                ],
                [
                    'name' => 'password',
                    'label' => 'Mot de passe',
                    'type' => 'password',
                    'placeholder' => 'Renseigner votre mot de passe',
                    "required" => true,
                ],
                [
                    'name' => 'repeat_password',
                    'label' => 'Mot de passe',
                    'type' => 'password',
                    'placeholder' => 'Renseigner votre mot de passe à nouveau',
                    "required" => true,
                ]
            ],
            'selects' => []
        ];
    }

    public function buildCreateEventForm(): array
    {
        return [
            'actionRoute' => 'post_create_event',
            'submit_button' => "Créer l'événement",
            'links' => [],
            'inputs' => [
                [
                    'name' => 'title',
                    'label' => 'Titre',
                    'type' => 'text',
                    'placeholder' => 'Titre de l\'événement',
                    'required' => true
                ],
                [
                    'name' => 'description',
                    'label' => 'description',
                    'type' => 'text',
                    'placeholder' => 'Description de l\'événement',
                    "required" => false,
                ],
                [
                    'name' => 'price',
                    'label' => 'Prix',
                    'type' => 'number',
                    'placeholder' => 'Prix de l\'événement',
                    "required" => false,
                ],
                [
                    'name' => 'start_date',
                    'label' => 'Date de début de l\'événement',
                    'type' => 'date',
                    'placeholder' => '',
                    "required" => true,
                ],
                [
                    'name' => 'end_date',
                    'label' => 'Date de fin de l\'événement',
                    'type' => 'date',
                    'placeholder' => '',
                    "required" => false,
                ],
                [
                    'name' => 'time',
                    'label' => 'Durée de l\'événement',
                    'type' => 'time',
                    'placeholder' => '',
                    "required" => false,
                ],
                [
                    'name' => 'category_id',
                    'label' => 'Ici y aura les choix de catégorie',
                    'type' => 'text',
                    'placeholder' => '',
                    "required" => false,
                ],
                [
                    'name' => 'is_published',
                    'label' => 'L\'événement doit-il être publié ?',
                    'type' => 'checkbox',
                    'placeholder' => '',
                    "required" => false,
                ],
            ],
            'selects' => [],
            'csrf_token' => $this->csrfTokenProvider->generate()
        ];
    }
}