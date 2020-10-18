<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Client;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $clientType = Client::getClientType($this->clientType);
        $documentType = $clientType == Client::TYPE_INDIVIDUAL ? 'cpf' : 'cnpj';
        $client = $this->route('client');
        $clientId = $client instanceof Client ? $client->id : null;
        $rules = [
            'name' => 'required|max:255',
            'document' => "required|unique:clients,document,$clientId|document:$documentType",
            'email' => 'required|email',
            'phone' => 'required',
        ];

        $maritalStatus = implode(',', array_keys(Client::MARITAL_STATUS));

        $rulesIndividual = [
            'dateBirth' => 'required|date',
            'gender' => 'required|in:m,f',
            'maritalStatus' => "required|in:$maritalStatus",
            'physicalDisability' => 'max:255'
        ];

        $rulesLegal = [
            'companyName' => 'required|max:255'
        ];

        return $clientType == Client::TYPE_INDIVIDUAL ?
            $rules + $rulesIndividual : $rules + $rulesLegal;
    }
}
