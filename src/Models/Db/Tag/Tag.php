<?php namespace FrenchFrogs\Models\Db\Tag;

use FrenchFrogs\Laravel\Database\Eloquent\Model;

class Tag extends Model
{
    protected $primaryKey  = 'tag_id';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tag';
    public $uuid = true;

    public function container()
    {
        return $this->belongsTo(Container::class, 'tag_id', 'tag_id');
    }

}