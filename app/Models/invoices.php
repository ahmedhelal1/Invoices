<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class invoices extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoices_number',
        'invoices_date',
        'due_date',
        'product',
        'section_id',
        'amount_collection',
        'amount_commission',
        'rate_vat',
        'value_vat',
        'note',
        'user',
        'discount',
        'total',
        'status',
        'value_status',
    ];
    // protected $guarded = [];
    public function section()
    {
        return $this->belongsTo(Sections::class);
    }
}
