@foreach($result as $p)
    <tr class="trLast" style="background-color: limegreen">
        <td class="partcode0">{{$p->barcode}}</td>
        <td class="barcode0"><a href="{{'https://www.bahook.com/product/'.$p->id}}" target="_blank"
                                onclick="return addName(this.text)"> {{$p->id}} </a></td>
        <td class="name0">{{$p->name}}</td>
        {{--<td class="tedad form-control-sm">--}}
        {{--{{$p->cnt}}--}}
        {{--<input class="inpTedad" min="1" onfocusout="countSum()" style="max-width:50px"--}}
        {{--type="number" class="form-control-sm" value="{{$p->cnt}}">--}}
        {{--</td>--}}
        {{--<td class="grp0 form-control-sm">{{$p->grp}}</td>--}}
        {{--<td class="price0 form-control-sm">{{ number_format($p->price,0) }}</td>--}}

        <td class="rmv form-control-sm" style="color: red;max-width:10px"
            onclick="rmv(this),countSum()">X
        </td>
        <td class="radif">1</td>
    </tr>
@endforeach
