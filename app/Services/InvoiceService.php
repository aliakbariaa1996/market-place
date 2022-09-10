<?php

namespace App\Services;

use App\Interfaces\InvoiceRepositoryInterface;
use App\Interfaces\InvoiceServiceInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\StoreRepositoryInterface;
use App\Interfaces\StoreServiceInterface;

class InvoiceService implements InvoiceServiceInterface
{
    /**
     * @var StoreRepositoryInterface
     */
    private $storeRepository;
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var InvoiceRepositoryInterface
     */
    private $invoiceRepository;

    public function __construct(StoreRepositoryInterface $storeRepository, ProductRepositoryInterface $productRepository,InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->storeRepository = $storeRepository;
        $this->productRepository = $productRepository;
        $this->invoiceRepository = $invoiceRepository;
    }


    public function buySingleProduct($store_id, $product_id, $user_id)
    {
        return $this->invoiceRepository->buySingleProduct($store_id, $product_id, $user_id);
    }

    public function singleInvoice($invoice_id)
    {
        return $this->invoiceRepository->singleInvoice($invoice_id);
    }

    public function userPurchases(int $user_id)
    {
        return $this->invoiceRepository->userPurchases($user_id);
    }

    public function updateInvoice(int $invoice_id, string $status)
    {
        return $this->invoiceRepository->updateInvoice($invoice_id,$status);
    }
}
