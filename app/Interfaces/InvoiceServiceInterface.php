<?php

namespace App\Interfaces;

interface InvoiceServiceInterface
{

    public function buySingleProduct($store_id, $product_id, $user_id);

    public function singleInvoice($invoice_id);

    public function userPurchases(int $user_id);

    public function updateInvoice(int $invoice_id, string $status);
}
