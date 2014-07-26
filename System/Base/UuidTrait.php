<?php namespace Ill\System\Base;

trait UuidTrait
{

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function($model)
        {
            $model->setIncrementing(false);
            $model->{$model->getKeyName()} = (string)$model->generateNewId();
        });
    }

    /**
     * Get a version 4 (kinda random) UUID.
     *
     * @return string
     */
    public function generateNewId()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

}