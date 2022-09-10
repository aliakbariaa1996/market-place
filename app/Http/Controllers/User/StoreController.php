<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserBuySingleProductRequest;
use App\Http\Resources\NearbyUserStoresCollection;
use App\Http\Resources\SingleUserStoreResource;
use App\Http\Resources\UserPaymentLinkResource;
use App\Http\Resources\UserPurchasesResourceCollection;
use App\Interfaces\InvoiceServiceInterface;
use App\Interfaces\StoreServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class StoreController extends Controller
{

    /**
     * @var StoreServiceInterface
     */
    private $storeService;
    /**
     * @var InvoiceServiceInterface
     */
    private $invoiceService;

    public function __construct(StoreServiceInterface $storeService, InvoiceServiceInterface $invoiceService)
    {
        $this->storeService = $storeService;
        $this->invoiceService = $invoiceService;
    }

    public function purchases(Request $request)
    {
        return new UserPurchasesResourceCollection(
            $this->invoiceService->userPurchases(auth()->user()->getAuthIdentifier())->orderBy("id", "desc")->paginate()
        );
    }

    public function nearbyStores(Request $request, $lat, $lon)
    {
        $perPage = 10;
        $page = Paginator::resolveCurrentPage() ?: 1;
        $items = $this->storeService->findNearbyStores($lat, $lon);
        $lap = new LengthAwarePaginator($items->forPage($page, $perPage),
            $items->count(),
            $perPage, $page, []);

        return new NearbyUserStoresCollection($lap);
    }

    public function singleStore(Request $request, $lat, $lon, $id)
    {
        return new SingleUserStoreResource($this->storeService->userStoreSingle($lat, $lon, $id));
    }

    public function buySingleProduct(UserBuySingleProductRequest $request, $lat, $lon, $id)
    {
        $store = $this->storeService->userStoreSingle($lat, $lon, $id);
        $invoice = $this->invoiceService->buySingleProduct($store->id, $request->product_id, auth()->user()->getAuthIdentifier());
        return new UserPaymentLinkResource(['link_to_pay' => route('payment', [$invoice->id])]);
    }

    public function pay(Request $request, $invoice_id)
    {
        $invoice = $this->invoiceService->singleInvoice($invoice_id);
        if (is_null($invoice)) abort(404);
        auth()->login(User::find($invoice->user_id));
        return view("payment")->with("invoice", $invoice);
    }

    public function payPass(Request $request, $invoice_id)
    {
        $invoice = $this->invoiceService->updateInvoice($invoice_id, "paid");
        return view("payment_pass")->with("invoice", $invoice);
    }

    public function payFail(Request $request, $invoice_id)
    {
        $invoice = $this->invoiceService->updateInvoice($invoice_id, "failed");
        return view("payment_fail")->with("invoice", $invoice);
    }

}
