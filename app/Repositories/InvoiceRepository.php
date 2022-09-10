<?php

namespace App\Repositories;

use App\Interfaces\InvoiceRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Invoice;
use App\Models\User;

class InvoiceRepository implements InvoiceRepositoryInterface
{


    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function buySingleProduct($store_id, $product_id, $user_id)
    {
        return Invoice::create([
            'product_id' => $product_id,
            'user_id' => $user_id,
            'status' => Invoice::STATUS_PENDING,
            'price_id' => $this->productRepository->getProductPrice($product_id)->id
        ]);
    }

    public function userPurchases(int $user_id)
    {
        return Invoice::whereUserId($user_id)->whereStatus("paid");
    }

    public function updateInvoice(int $invoice_id, string $status)
    {
        $invoice = $this->singleInvoice($invoice_id);
        if (is_null($invoice)) abort(404);
        auth()->login(User::find($invoice->user_id));
        $invoice->update(["status" => $status]);
        return $invoice;
    }

    public function singleInvoice($invoice_id)
    {
        return Invoice::whereId($invoice_id)->whereStatus("pending")->first();
    }
}
