<?php

namespace App\Mail;

enum OhanoMail: string
{
    case AccountActivation = 'account_activation';
    case AccountVerificationAccepted = 'account_verification_accepted';
    case AccountVerificationUpdated = 'account_verification_updated';
}