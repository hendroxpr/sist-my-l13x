<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style>
    
    @page{
      margin-top: 10px;
      margin-left: 20px;
      margin-right: 10px;
    }
    header{
      position: fixed;
      left: 0px;
      right: 0px;
      height: 60px;
      margin-top: -60px;
    }
    
    
    div {
        font-family: sans-serif, Helvetica, Lucida, Arial;
        font-stretch: condensed;
        font-size: 0.8em;
        line-height:0.7
    }
    </style>

</head>
<body>

  @php
      use Riskihajar\Terbilang\Terbilang;
  @endphp

<div>
  <table style="width: 100%" border="0">
      <tr>
        <td style="width: 40%"><h2><b>KWINTANSI PEMBAYARAN</b></h2></td>
        <td style="width: 2%">:</td>
        <td style="width: 58%" colspan="5"><h2><b>KWINTANSI PEMBAYARAN</b></h2></td>
      </tr>
      <tr>
        <td>Nomor : {{ $tagihan[0]->nomorbukti1 }}</td>
        <td>:</td>
        <td style="width: 15%">Nomor</td>
        <td style="width: 2%">:</td>
        <td style="width: 41%" colspan="3">{{ $tagihan[0]->nomorbukti1 }}</td>
      </tr> 
      <tr>
        <td>Telah terima dari :</td>
        <td>:</td>
      </tr> 
      <tr>
        <td> &nbsp; &nbsp; {{ $tagihan[0]->datasiswa->namalengkap }}</td>
        <td>:</td>
        <td>Telah terima dari</td>
        <td>:</td>
        <td colspan="3">{{ $tagihan[0]->datasiswa->namalengkap }}</td>
      </tr>
      <tr>
        <td> &nbsp; &nbsp; {{ $tagihan[0]->datasiswa->nisn }} / {{ $kelas[0]->kelas }}</td>
        <td>:</td>
        <td></td>
        <td></td>
        <td colspan="3">{{ $tagihan[0]->datasiswa->nisn }} / {{ $kelas[0]->kelas }}</td>
      </tr>
      <tr>
        <td>Uang sebesar :</td>
        <td>:</td>
      </tr> 
      <tr>
        <td> &nbsp; &nbsp;
          @php
              echo 'Rp. ' . number_format($tagihan[0]->bayar,2)
          @endphp 
          
        </td>
        <td>:</td>
        <td>Uang sebesar</td>
        <td>:</td>
        <td colspan="3">{{ ucwords(Riskihajar\Terbilang\Facades\Terbilang::make($tagihan[0]->bayar,' rupiah','')) }}</td>
      </tr> 
      <tr>
        <td>Guna membayar :</td>
        <td>:</td>
      </tr> 
      <tr>
        <td> &nbsp; &nbsp; {{ $tagihan[0]->jenistagihan->jenistagihan }}</td>
        <td>:</td>
        <td>Guna membayar</td>
        <td>:</td>
        <td colspan="3">{{ $tagihan[0]->jenistagihan->jenistagihan }}</td>
      </tr>
      <tr>
        <td> &nbsp; &nbsp; </td>        
      </tr>
      <tr>
        <td> &nbsp; &nbsp; {{ session('memkotattd') }}, {{ Carbon\Carbon::parse($tagihan[0]->tgltransaksi)->format('d F Y') }}</td>
        <td>:</td>
        <td></td>
        <td></td>
        <td style="width: 8%"></td>
        <td style="width: 1%"></td>
        <td>{{ session('memkotattd') }}, {{ Carbon\Carbon::parse($tagihan[0]->tgltransaksi)->format('d F Y') }}</td>
      </tr>
      <tr>
        <td> &nbsp; &nbsp; Bendahara Penerima,</td>
        <td>:</td>
        <td colspan="3">---------------------------------------</td>        
        <td></td>
        <td>Bendahara Penerima,</td>
      </tr>
      <tr>
        <td> &nbsp; &nbsp;</td>
        <td>:</td>
        <td colspan="3">
          @php
              echo '<i>Terbilang Rp. ' . number_format($tagihan[0]->bayar,2).'</i>';
          @endphp  
        </td>        
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td> &nbsp; &nbsp; </td>
        <td>:</td>
        <td colspan="3">---------------------------------------</td>        
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td> &nbsp; &nbsp; <b><u>{{ $tagihan[0]->dataguru->nama }}</u></b></td>
        <td>:</td>
        <td colspan="3"></td>        
        <td></td>
        <td><b><u>{{ $tagihan[0]->dataguru->nama }}</u></b></td>
      </tr>
  
  </table>
</div>



<script type="text/javascript">
   
$(document).ready(function(){
    
   

});
</script>	

</body>