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
            'selects' => [],
            'csrf_token' => $this->csrfTokenProvider->generate()
        ];
    }
}