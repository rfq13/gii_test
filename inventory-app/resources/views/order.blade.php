@php
    $type = isset($type) ? $type : 'penjualan';

    $orders = \DB::table('order');
    if ($type == 'penjualan') {
          $orders = $orders->where('stock','<',0);
     }else {
          $orders = $orders->where('stock','>=',0);
    }

    $orders = $orders->get();
@endphp

@extends('app')

@section('content')
<div class="container my-4">
     <div class="card">
          <div class="card-header">
               <a href="javascript:void(0)" class="float-right btn btn-sm btn-success" style="text-transform: uppercase" data-toggle="modal" data-target="#modalCreate">+</a>
               <a href="{{ url('home') }}" class="mx-4 btn btn-sm btn-primary">back</a>
               Data {{ $type }}
          </div>
          <div class="card-body">
               <table class="table">
                    <thead>
                         <tr>
                              <th scope="col">#</th>
                              <th scope="col">Nama</th>
                              <th scope="col">Inventory</th>
                              <th scope="col">Biaya</th>
                              <th scope="col">Stock</th>
                              <th scope="col"></th>
                         </tr>
                    </thead>
                    <tbody>
                         @foreach ($orders as $key => $order)
                         @php
                             $inventory = \DB::table('inventory')->select('cost','name')->find($order->inventory_id);
                         @endphp
                         <tr>
                              <th scope="row">{{ $key+1 }}</th>
                              <td>{{ \DB::table('users')->select('name')->find($order->user_id)->name }}</td>
                              <td>{{ $inventory->name }}</td>
                              <td>{{ $inventory->cost }}</td>
                              <td>{{ $order->stock < 0 ? $order->stock*-1 : $order->stock }}</td>
                              <td>
                                   <a href="{{ route('order.delete',$order->id) }}" class="btn btn-sm btn-danger">Hapus</a>
                              </td>
                         </tr>
                         @endforeach
                    </tbody>
                    </table>
          </div>
     </div>
</div>
   
   <!-- Modal -->
   <div class="modal fade" id="modalCreate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="staticBackdropLabel"> tambah data {{ $type }}</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <form action="{{ route('order.store') }}" method="POST">
          <input type="hidden" name="type" value="{{ $type }}">
               <div class="modal-body">
                    @csrf
                    <div class="row">
                         <div class="col">
                              <select class="custom-select" name="user_id">
                                   <option selected>Pilih pembeli</option>
                                   @foreach (\DB::table('users')->get() as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                   @endforeach
                              </select>
                         </div>
                         <div class="col">
                              <select class="custom-select" name="inventory_id">
                                   <option selected>Pilih inventory</option>
                                   @foreach (\DB::table('inventory')->get() as $inventory)
                                        <option value="{{ $inventory->id }}">{{ $inventory->name }}</option>
                                   @endforeach
                              </select>
                         </div>
                         <div class="col">
                              <input type="text" class="form-control" name="stock" required placeholder="Stock">
                         </div>
                    </div>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
               </div>
          </form>
       </div>
     </div>
   </div>
@endsection