<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportExcel extends Model
{
    use HasFactory;

    protected $fillable = [
        'SID',
        'Pkgs',
        'Recipient',
        'ContactName',
        'AddressLine1',
        'AddressLine2',
        'City',
        'State',
        'PostalCode',
        'StopInstructions',
        'Phone',
        'Completed'
    ];
}
