@section('js')
<script type="text/javascript">
    $(document).ready(function() {
    $('#table').DataTable({
        "iDisplayLength": 50
    });

} );

$(document).on("click", ".btn-data", function () {
    var itemid= $(this).attr('data-item'), kodeTransaksi = $(this).attr('kode-transaksi');
    $("#lineitem").attr("action","/transaksi/"+itemid);
    $("#kodeitem").text(kodeTransaksi);
});
</script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-2">
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Transaksi</a>
    </div>

    <div class="col-lg-12">
        @if (Session::has('message'))
        <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
        @endif
    </div>
</div>

<div class="row" style="margin-top: 20px;">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">
                <h4 class="card-title">Data Transaksi</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Buku</th>
                                <th>Peminjam</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th>Jumlah Buku Dipinjam</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach($dataTransaksis as $data)
                            <tr>
                                <td class="py-1">
                                    <a href="{{route('transaksi.show', $data->id)}}"> 
                                        {{$data->kode_transaksi}}
                                    </a>
                                </td>

                                <td>                          
                                    {{$data->buku->judul}}
                                </td>

                                <td>
                                    {{$data->anggota->name}}
                                </td>
                                
                                <td>
                                    {{date('d/m/y', strtotime($data->tgl_pinjam))}}
                                </td>

                                <td>
                                    {{date('d/m/y', strtotime($data->tgl_kembali))}}
                                </td>

                                <td>
                                    {{$data->jumlah_buku_dipinjam}}
                                </td>
                                
                                <td>
                                    @if($data->status == 'pinjam')
                                        <label class="badge badge-warning">Pinjam</label>
                                    @else
                                        <label class="badge badge-success">Kembali</label>
                                    @endif
                                </td>
                                
                                <td>
                                    @if(Auth::user()->level == 'admin')
                                        <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                                        @if($data->status == 'pinjam')
                                        <form action="{{ route('transaksi.update', $data->id) }}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{ method_field('put') }}
                                            <button class="dropdown-item"> Sudah Kembali
                                            </button>
                                        </form>
                                        @endif
                                        <button data-item="{{ $data->id }}" kode-transaksi="{{$data->kode_transaksi}}" class="dropdown-item btn-data" data-toggle="modal" data-target="#myModal"> 
                                            Delete
                                        </button>
                                        </div>
                                        </div>
                                    @else
                                        @if($data->status == 'pinjam')
                                        -
                                        @else
                                        -
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        {{--  {!! $dataTransaksis->links() !!} --}}
            </div>
        </div>
    </div>

</div>


    @if(Auth::user()->level == 'admin')
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document" >
        
    <div class="modal-content" style="background: #fff;">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Transaksi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>

    <div class="modal-body">
        Apakah anda ingin menghapus data transaksi , <span class="text-danger" id="kodeitem"></span>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="" class="pull-left"  method="post" id="lineitem">
        {{ csrf_field() }}
        {{ method_field('delete') }}
        <button class="btn btn-danger"> Delete
        </button>
        </form>
    </div>

    </div>
    </div>
    </div>
    @endif


@endsection