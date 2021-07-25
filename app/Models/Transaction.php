<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'payer', 'payee', 'value'
    ];

    protected $hidden = [
        'id',
        'updated_at'
    ];

    protected $attributes = [
        'value' => 0.00
    ];
}
