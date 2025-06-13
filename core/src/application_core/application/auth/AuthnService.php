<?php

namespace App\application_core\application\auth;

use App\application_core\application\auth\interfaces\AuthnServiceInterface;
use App\application_core\domain\entities\User;
use Couchbase\AuthenticationException;

class AuthnService implements AuthnServiceInterface {
    public function register($email, $mdp) : array
    {
        if(User::where('email','=', $email)->count() == 0) {
            $mdpHash = password_hash($mdp, PASSWORD_BCRYPT);
            $user = new User();
            $user->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $user->email = $email;
            $user->password = $mdpHash;
            $user->role = 100;
            $user->save();
            return $user->toArray();
        } else {
            throw new AuthenticationException("Cet utilisateur existe déjà.");
        }
    }

    public function verifyCredentials($email, $mdp): bool {
        $user = User::where('email','=', $email)->first();
        if($user == null) {
            throw new AuthenticationException("TEMPORAIRE A SUPPRIMER. Utilisateur inexistant.");
            //throw new AuthenticationException("Erreur lors de l'authentification.");
        } else {
            if (!password_verify($mdp,$user->password)) {
                throw new AuthenticationException("pas meme");
                //throw new AuthenticationException("Erreur lors de l'authentification.");
            } else {
                return true;
            }
        }
    }
}