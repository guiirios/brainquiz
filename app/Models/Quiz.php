<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quiz';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_quiz';

    /**
     * The primary key associated with the table.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['titulo','foto','id_categoria','id_usuario'];

    /**
     * ---------------------------------
     * | Relacionamentos
     * | https://laravel.com/docs/9.x/eloquent-relationships
     * ----------------------------------
     */

     /**
      * Retorna o categoria
      *
      * @return void
      */
      public function categoria()
      {
         return $this->hasMany(Categoria::class,'id_categoria','id_categoria');
      }

}
