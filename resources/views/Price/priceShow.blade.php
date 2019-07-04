@foreach($res as $r)
    <tr>
        <td>{{$r->partcode}}</td>
        <td>{{$r->partname}}</td>
        <td>{{number_format($r->priceInDate,0)}}</td>
        <td>{{number_format($r->priceOld,0)}}</td>
        <td>{{$r->datePicked}}</td>
        <td>{{$r->grp}}</td>
        <td>{{(int)$r->B1}}</td>
        <td>{{(int)$r->B2}}</td>
        <td>{{(int)$r->B3}}</td>
        <td>{{(int)$r->B4}}</td>
    </tr>
@endforeach
