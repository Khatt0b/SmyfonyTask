<?php

namespace App\Security\Voter;

use App\Entity\Article;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class ArticleVoter extends Voter
{
    protected function supports(string $attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['ARTICLE_EDIT', 'ARTICLE_SHOW',"ARTICLE_DELETE"])
            && $subject instanceof \App\Entity\Article;
    }

    protected function voteOnAttribute(string $attribute,$article, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'ARTICLE_DELETE':
            case 'ARTICLE_EDIT':

                if($user->getUsername()==$article->getAuthor() || in_array("ROLE_ADMIN",$user->getRoles())){
                    return true;
                }
                break;

        }

        return false;
    }
}
