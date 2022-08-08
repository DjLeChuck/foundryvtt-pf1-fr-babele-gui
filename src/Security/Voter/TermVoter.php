<?php

namespace App\Security\Voter;

use App\Entity\Term;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class TermVoter extends Voter
{
    public const APPROVED = 'approve';

    private array $approvers;

    public function __construct(array $approvers)
    {
        $this->approvers = $approvers;
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        return self::APPROVED === $attribute && $subject instanceof Term;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return false;
        }

        return \in_array($user->getUserIdentifier(), $this->approvers, true);
    }
}
