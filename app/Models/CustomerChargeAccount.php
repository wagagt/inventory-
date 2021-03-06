<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class CustomerChargeAccount extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'customer_charge_accounts';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const CURRENCY_SELECT = [
        'QTZ' => 'Quetzalez',
        'USD' => 'Dolares Americanos',
        'EUR' => 'Euros',
        'GBP' => 'Libra Esterlina',
    ];

    protected $fillable = [
        'date',
        'payment_type',
        'amount',
        'doc_no',
        'exchage_currency',
        'customer_id',
        'currency',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const PAYMENT_TYPE_SELECT = [
        'cash'           => 'Efectivo',
        'check'          => 'Cheque',
        'debit_card'     => 'Tarjeta de Débito',
        'credit_card'    => 'Tarjeta de Crédito',
        'bank_transfer'  => 'Transferencia Bancaria',
        'mobile_payment' => 'Pago con Teléfono',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function customer()
    {
        return $this->belongsTo(CrmCustomer::class, 'customer_id');
    }
}
