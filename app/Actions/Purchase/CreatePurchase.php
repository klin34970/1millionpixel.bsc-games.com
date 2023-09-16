<?php

namespace App\Actions\Purchase;

use App\Contracts\Purchase\CreatesPurchase;
use App\Models\Purchase;
use Illuminate\Support\Facades\Validator;


class CreatePurchase implements CreatesPurchase
{

    /**
     * Validate and create.
     *
     * @param  array  $input
     * @return mixed
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'title' => ['required', 'string', 'min:3', 'max:128'],
            'link' => ['required', 'url', 'max:128'],
            'photo' => ['required', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('createPurchase');

        $purchase =  Purchase::create([
            'title' => $input['title'],
            'link' => $input['link'],
        ]);

        $purchase->updateUpload($input['photo']);

        return $purchase;
    }
}
