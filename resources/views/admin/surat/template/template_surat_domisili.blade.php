<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
body{
    font-family: serif;
    font-size: 14px;
    line-height: 1.6;
    margin:40px;
}

.header{
    text-align:center;
    border-bottom:2px solid black;
    padding-bottom:10px;
    margin-bottom:20px;
}

.header h2{
    margin:0;
    font-size:20px;
}

.header h3{
    margin:0;
    font-size:18px;
}

.title{
    text-align:center;
    font-weight:bold;
    margin-top:20px;
    text-decoration: underline;
}

.nomor{
    text-align:center;
    margin-bottom:20px;
}

.table{
    width:100%;
    margin-top:10px;
}

.table td{
    padding:4px;
    vertical-align:top;
}

.ttd{
    margin-top:60px;
    width:100%;
    text-align:right;
}
</style>
</head>
<body>

<div class="header">
    <h2>PEMERINTAH KABUPATEN TOBA</h2>
    <h2>KECAMATAN BALIGE</h2>
    <h2>DESA HUTABULU MEJAN</h2>
</div>

<div class="title">
SURAT KETERANGAN DOMISILI
</div>

<div class="nomor">
Nomor : {{ $surat->nomor_surat }}
</div>

<p>Yang bertanda tangan di bawah ini Kepala Desa Hutabulu Mejan menerangkan bahwa:</p>

<table class="table">
<tr>
<td width="35%">Nama Lengkap</td>
<td>: {{ $surat->nama }}</td>
</tr>

<tr>
<td>NIK</td>
<td>: {{ $surat->nik }}</td>
</tr>

<tr>
<td>Tempat / Tanggal Lahir</td>
<td>: {{ $surat->ttl }}</td>
</tr>

<tr>
<td>Jenis Kelamin</td>
<td>: {{ $surat->jenis_kelamin }}</td>
</tr>

<tr>
<td>Alamat</td>
<td>: {{ $surat->alamat }}</td>
</tr>
</table>

<p>
Adalah benar warga Desa Hutabulu Mejan dan berdomisili pada alamat tersebut di atas.
</p>

<p>
Surat keterangan ini dibuat untuk keperluan:
<b>{{ $surat->keperluan }}</b>
</p>

<p>
Demikian surat ini dibuat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.
</p>

<div class="ttd">
Hutabulu Mejan, {{ date('d-m-Y') }}<br>
Kepala Desa Hutabulu Mejan
<br><br><br><br>

(______________________)
</div>

</body>
</html>