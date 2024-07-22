<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParceiroPolo extends Model
{
    protected $table = 'parceiro_polos';

    public function parceiro()
    {
        return $this->hasOne(Parceiro::class, 'id', 'parceiro_id');
    }

    public function polo()
    {
        return $this->hasOne(Polo::class, 'id', 'polo_id');
    }
}
