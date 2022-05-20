<table style="position:absolute; top:5px; width:100%; height:100px;display:inline-block; vertical-align:top;">
    <tr>
        <th style="display:inline;"><img style="width: 140px" src="imgs/gobernacion.png"/></th>
        <th style="display:inline;"> {{session('aeropuerto')->nombre }}</th>
    </tr>
</table>


<div style="margin-top:20px; color: black; font-size: 18px;font-weight: bold" align="center" class="text-center">ACTA DE CIERRE DEL DÍA</div>
<div style="margin-top:12px; color: black; font-size: 12px;" align="center" class="text-center">{{ $fecha }}</div>
<br>
<div style="margin-top:20px; color: black; font-size: 16px;" align="center" class="text-center">PAGOS</div>
<div>
{!! $table1 !!}
</div>
<br><br>
<div style="margin-top:20px; color: black; font-size: 16px;" align="center" class="text-center">TOTALES</div>
<div align="center" style="margin-left: auto; margin-right: auto; max-width: 600px;">
{!! $table2 !!}
</div>
<br><br>
<div style="margin-top:20px; color: black; font-size: 16px;" align="center" class="text-center">COBROS</div>
<div>
{!! $table3 !!}
</div>
<br><br><br><br><br><br><br>
<div  style="position:absolute; bottom:100px;width:100%;height:60px;">
<table style="width:100%; border-collapse: collapse; padding: 2px; empty-cells: show;">
    <thead>
        <td  colspan="1">&nbsp;</td>
        <td  colspan="3"><strong></strong></td>
        <td  colspan="4">&nbsp;</td>
        <td  colspan="3"><strong></strong></td>
        <td  colspan="1">&nbsp;</td>
    </thead>
    <tbody>
    <tr>
        <td colspan="1"></td>
        <td colspan="3">{{ session('user')->fullname }}</td>
        <td colspan="4"></td>
        <td colspan="3"></td>
        <td colspan="1"></td>
    </tr>
    <tr>
        <td     colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td     colspan="3" style="border-top: 1px solid black;">
            <strong class="text-center">Firma Funcionario Módulo <br> Tasa Aeroportuaria </strong>
        </td>
        <td     colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td     colspan="3" style="border-top: 1px solid black;">
            <strong class="text-center">Firma Funcionario Departamento <br> Recaudacíon</strong>
        </td>
        <td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    </tbody>
</table>
</div>
