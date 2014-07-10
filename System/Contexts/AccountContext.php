<?php namespace Ill\System\Contexts;

use Illuminate\Database\Eloquent\Model;

class AccountContext implements Context
{

    /**
     * The current context
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $context;

    /**
     * Set the context
     *
     * @param \Illuminate\Database\Eloquent\Model $context
     * @internal param $ Illuminate\Database\Eloquent\Model
     */
    public function set(Model $context)
    {
        $this->context = $context;
    }

    /**
     * Check to see if the context has been set
     *
     * @return boolean
     */
    public function has()
    {
        if($this->context) return true;

        return false;
    }

    /**
     * Get the context identifier
     *
     * @return integer
     */
    public function id()
    {
        return $this->context->id;
    }

    /**
     * Get the context column
     *
     * @return string
     */
    public function column()
    {
        return 'account_id';
    }

    /**
     * Get the context table name
     *
     * @return string
     */
    public function table()
    {
        return 'accounts';
    }

}
