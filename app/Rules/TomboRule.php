<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Item;

class TomboRule implements Rule
{
    private $item;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $busca = Item::where('tombo',$value)->first();
        if(empty($busca)) return true;

        if($busca->id == $this->item->id) return true;
        
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tombo está em uso em outro registro';
    }
}
