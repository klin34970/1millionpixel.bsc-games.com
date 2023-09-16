<?php

namespace App\Contracts\Purchase;

interface CreatesPurchase
{
    /**
     * Validate and create.
     *
     * @param  array  $input
     * @return mixed
     */
    public function create(array $input);
}
