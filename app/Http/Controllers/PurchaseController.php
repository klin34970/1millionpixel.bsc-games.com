<?php

namespace App\Http\Controllers;

use App\Actions\Purchase\CreatePurchase;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends UploadController
{
    public function store(Request $request){
        $purchase = app(CreatePurchase::class)->create($request->all());
        $upload = route('purchase.upload', $purchase->uploads->first());
        return redirect()->back()->with([
            'flash' => [
                'title' => $purchase->title,
                'link' => $purchase->link,
                'image' => $upload
            ]
        ]);
    }
}
