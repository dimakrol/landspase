<?php

namespace Modules\Admin\Http\Controllers\Valuation\Order;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Admin\Http\Controllers\AdminBaseController;
use App\Models\Valuation\Order\Status;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Modules\Admin\Http\Requests\StatusRequest;

class StatusController extends AdminBaseController
{
    public function index()
    {
        return view('admin::valuation.order.index');
    }

    /**
     * Process datatables ajax request.
     * @param Request $request
     * @return mixed
     */
    public function orderStatusData(Request $request)
    {
        if ($request->ajax()) {
            $status = Status::all();
            return Datatables::of($status)
                ->editColumn('is_protected', function ($r) {
                    return ($r->is_protected) ? 'Yes' : 'No';
                })
                ->addColumn('action', function ($r) {
                    return view('admin::valuation.order.partials._orders_options', ['row' => $r]);
                })
                ->make(true);
        }
    }

    /**
     * create Alternative Valuation Order Statuses
     * @param Request $request
     * @param Status $status
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function createOrderStatus(Request $request, Status $status)
    {
        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
            ]);
            if (!$validator->fails()) {
                $data = $request->all();
                $data['code'] = strtoupper(str_slug($data['name'], '_'));
                if($countStatus = Status::where('code',$data['code'])->count() > 0){
                    $data['code'] = $data['code'].'_'.str_random(3);
                }
                $data['is_protected'] = 1;
                $create = $status->create($data);
                if ($create) {
                    Session::flash('success', 'Alternative Valuation Order Status Updated.');
                    return redirect()->route('admin.valuation.orders.status');
                }
            } else {
                return redirect()->back()->withErrors($validator);
            }

        }
        return view('admin::valuation.order.create', compact('status'));
    }

    /**
     * @param Request $request
     * @param Status $status
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function updateOrderStatus(StatusRequest $request, Status $status)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $update = $status->update($data);
            if ($update) {
                Session::flash('success', 'Alternative Valuation Order Status Updated.');
                return redirect()->route('admin.valuation.orders.status');
            }
        }
    }

    /**
     * @param Status $status
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function deleteOrderStatus(Status $status)
    {
        if($status->is_protected == 1){
            Session::flash('error', 'You cannot delete that item');
            return redirect()->route('admin.valuation.orders.status');
        }
        $status->delete();
        Session::flash('success', 'Alternative Valuation Order Status Deleted.');
        return redirect()->route('admin.valuation.orders.status');
    }
}
