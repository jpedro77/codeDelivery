<?php

namespace CodeDelivery\Http\Controllers;

use Illuminate\Http\Request;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;

class OrdersController extends Controller
{
    private $repository;
    private $orderService;

    public function __construct(OrderRepository $repository, OrderService $orderService)
    {
        $this->repository = $repository;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->repository->paginate();
        $listStatus = $this->orderService->listStatus();

        return view('admin.orders.index', compact('orders', 'listStatus'));
    }

    public function edit($id, UserRepository $userRepository)
    {
        $listStatus = $this->orderService->listStatus();
        $order = $this->repository->find($id);
        $deliveryman = $userRepository->getDeliveryman();

        return view('admin.orders.edit', compact('order', 'listStatus', 'deliveryman'));
    }

    public function update(Request $request, $id)
    {
        $all = $request->all();
        $this->repository->update($all, $id);

        return redirect()->route('admin.orders.index');
    }
}
