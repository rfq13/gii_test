@extends('app')

@section('content')
<div class="container my-4">
     <div class="card">
          <div class="card-header">
               <a href="javascript:void(0)" class="float-right btn btn-sm btn-success" data-toggle="modal" data-target="#modalCreate">+</a>
               <a href="{{ route('order.index') }}?type=pembelian" class="float-right btn btn-sm btn-primary mx-2">data pembelian</a>
               <a href="{{ route('order.index') }}?type=penjualan" class="float-right btn btn-sm btn-warning mx-2">data penjualan</a>
               Data Inventory
          </div>
          <div class="card-body">
               <table class="table">
                    <thead>
                         <tr>
                              <th scope="col">#</th>
                              <th scope="col">Nama</th>
                              <th scope="col">Biaya</th>
                              <th scope="col">Stock</th>
                              <th scope="col"></th>
                         </tr>
                    </thead>
                    <tbody>
                         @foreach (\DB::table('inventory')->get() as $key => $inventory)
                         <tr>
                              <th scope="row">{{ $key+1 }}</th>
                              <td>{{ $inventory->name }}</td>
                              <td>{{ $inventory->cost }}</td>
                              <td>{{ $inventory->stock }}</td>
                              <td>
                                   <a href="{{ route('inventory.delete',$inventory->id) }}" class="btn btn-sm btn-danger">Hapus</a>
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
           <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <form action="{{ route('inventory.store') }}" method="POST">
               <div class="modal-body">
                    @csrf
                    <div class="row">
                         <div class="col">
                              <input type="text" class="form-control" name="name" required placeholder="Name">
                         </div>
                         <div class="col">
                              <input type="text" class="form-control" name="cost" required placeholder="Biaya">
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