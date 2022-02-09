<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agen extends Model
{
	use LogsActivity;
    use SoftDeletes;
    protected $table = 'agen';

    
    protected static $logAttributes = ['nama', 'idkota1','idkota2','idkota3','idkota4','idkota5','idkota6','idkota7','idkota8','idkota9','idkota10','kode','alamat','no_telp','presentase','presentasetransit','has_harga_khusus',
    'harga_doc',
    'harga_kg',
    'harga_kg_selanjutnya',
    'harga_koli_b',
    'harga_koli_bb',
    'harga_koli_k',
    'harga_koli_s'];

    protected $fillable = [
        'nama', 'idkota1','idkota2','idkota3','idkota4','idkota5','idkota6','idkota7','idkota8','idkota9','idkota10','kode','alamat','no_telp','presentase','presentasetransit','has_harga_khusus',
        'harga_doc',
        'harga_kg',
        'harga_kg_selanjutnya',
        'harga_koli_b',
        'harga_koli_bb',
        'harga_koli_k',
        'harga_koli_s' 
    ];
}
