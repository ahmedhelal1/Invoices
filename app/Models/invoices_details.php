<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\sections;

class invoices_details extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function sections()
    {
        return $this->belongsTo(Sections::class, 'section');
    }
}
