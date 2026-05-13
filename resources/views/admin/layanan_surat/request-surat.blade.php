@extends('admin.beranda')

@section('content')

<div class="container-fluid py-4">

<h3 class="fw-bold mb-4">📄 Permintaan Surat</h3>

<div class="card border-0 shadow rounded-4">
<div class="card-body">

<table class="table align-middle">

<thead class="table-primary">
<tr>
<th>No</th>
<th>Nama</th>
<th>Jenis Surat</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

@foreach($data as $row)

<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $row->penduduk->nama }}</td>
<td>{{ $row->jenisSurat->nama_surat }}</td>

<td>

@if($row->status=='diajukan')
<span class="badge bg-warning">Menunggu</span>
@endif

@if($row->status=='ditolak')
<span class="badge bg-danger">Ditolak</span>
@endif

@if($row->status=='selesai')
<span class="badge bg-success">Selesai</span>
@endif

</td>

<td>

@if($row->status=='diajukan')

<form method="POST"
action="{{ route('admin.surat.approve',$row->id_pengajuan_surat) }}">
@csrf
<button class="btn btn-success btn-sm">
Approve
</button>
</form>

@endif

@if($row->status=='selesai')

<a href="{{ asset($row->file_surat) }}"
target="_blank"
class="btn btn-primary btn-sm">
PDF
</a>

@endif

</td>

</tr>

@endforeach

</tbody>

</table>

</div>
</div>

</div>

@endsection