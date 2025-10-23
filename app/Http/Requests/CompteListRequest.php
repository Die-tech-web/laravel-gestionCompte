<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompteListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Authorization will be handled in the controller
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'page' => ['sometimes', 'integer', 'min:1'],
            'limit' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'type' => ['sometimes', 'in:epargne,cheque'],
            'statut' => ['sometimes', 'in:actif,bloque,ferme'],
            'search' => ['sometimes', 'string', 'max:255'],
            'sort' => ['sometimes', 'in:dateCreation,solde,titulaire'],
            'order' => ['sometimes', 'in:asc,desc'],
        ];
    }

    public function messages(): array
    {
        return [
            'page.integer' => 'Le numéro de page doit être un entier.',
            'page.min' => 'Le numéro de page doit être au moins 1.',
            'limit.integer' => 'La limite doit être un entier.',
            'limit.min' => 'La limite doit être au moins 1.',
            'limit.max' => 'La limite ne peut pas dépasser 100.',
            'type.in' => 'Le type de compte doit être "epargne" ou "cheque".',
            'statut.in' => 'Le statut doit être "actif", "bloque" ou "ferme".',
            'search.string' => 'Le terme de recherche doit être une chaîne de caractères.',
            'search.max' => 'Le terme de recherche ne peut pas dépasser 255 caractères.',
            'sort.in' => 'Le tri doit être par "dateCreation", "solde" ou "titulaire".',
            'order.in' => 'L\'ordre de tri doit être "asc" ou "desc".',
        ];
    }
}
