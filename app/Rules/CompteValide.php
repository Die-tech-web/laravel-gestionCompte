<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Compte; // Import the Compte model

class CompteValide implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Validate numeroCompte uniqueness
        if (Compte::where('numeroCompte', $value)->exists()) {
            $fail('Le numéro de compte existe déjà.');
        }

        // Validate numeroCompte format (e.g., string, min length 10, max length 20)
        if (!is_string($value) || strlen($value) < 10 || strlen($value) > 20) {
            $fail('Le numéro de compte doit être une chaîne de caractères entre 10 et 20 caractères.');
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Le numéro de compte fourni est invalide ou déjà utilisé.';
    }
}
