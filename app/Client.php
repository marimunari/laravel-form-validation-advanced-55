<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    const TYPE_INDIVIDUAL = 'individual';

    const TYPE_LEGAL = 'legal';

    const MARITAL_STATUS = [
        1 => 'Solteiro',
        2 => 'Casado',
        3 => 'Divorciado'
    ];

    protected $fillable = [
        'name',
        'document',
        'email',
        'phone',
        'defaulter',
        'dateBirth',
        'gender',
        'maritalStatus',
        'physicalDesability',
        'companyName',
        'clientType'
    ];

    public static function getClientType($type)
    {
        return $type == Client::TYPE_LEGAL ? $type : Client::TYPE_INDIVIDUAL;
    }

    public function getGenderFormattedAttribute()
    {
        return $this->clientType == self::TYPE_INDIVIDUAL ? ($this->gender == 'm' ? 'Masculino' : 'Feminino') : "";
    }

    public function getDateBirthFormattedAttribute()
    {
        return $this->clientType == self::TYPE_INDIVIDUAL ? (new \DateTime($this->dateBirth))->format('d/m/Y') : "";
    }

    public function getDocumentFormattedAttribute()
    {
        $document = $this->document;
        if (!empty($document)) {
            if (strlen($document) == 11) {
                $document = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $document);
            } elseif (strlen($document) == 14) {
                $document = preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $document);
            }
        }
        return $document;
    }

    public function setDocumentAttribute($value)
    {
        $this->attributes['document'] = preg_replace('/[^0-9]/', '', $value);
    }
}
