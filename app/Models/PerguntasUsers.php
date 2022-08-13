<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerguntasUsers extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'perguntas_users';

    protected $primary_key = 'id_pergunta_user';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = ['id_pergunta','id_user'];

     public function __construct(int $id_user = null, int $id_pergunta = null)
    {
        $this->attributes['id_user'] = $id_user;
        $this->attributes['id_pergunta'] = $id_pergunta;
    }

    public function perguntas()
    {
        return $this->hasMany(Pergunta::class,'id_quiz','id_quiz');
    }

    public function users()
    {
       return $this->hasMany(User::class,'id_user','id');
    }
}
