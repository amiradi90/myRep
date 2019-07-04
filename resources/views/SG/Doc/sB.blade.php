@foreach($result as $p)
    <tr class="trLast" style="background-color: limegreen;"
        onclick="$('.trLast').children().css('background-color','');$(this).find('.rmv,.price0,.grp0,.tedad,.barcode0,.partcode0,.name0,.radif').css('background-color','#5B89FF')">
        <td class="barcode0" id="barcodebarcode0" style="">{{$p->barcode}}</td>
        <td class="partcode0" style="" ondblclick="showRemain(this.id)" id="{{$p->partcode}}">{{$p->partcode}}</td>
        <td class="name0">{{$p->name}}</td>
        <td class="tedad form-control-sm ">
            <input class="inpTedad input-group-text" min="1" onchange="countSum()" pattern="[1-9]*" tabindex="-1"
                   type="number" class="form-control-sm" value="{{$p->cnt}}"
                   style="direction: ltr;color: red;font-weight: bolder;text-align:left;padding-left: 3px;">
        </td>
        <td class="grp0 form-control-sm">{{$p->grp}}</td>
        <td class="price0 form-control-sm">
            {{--@if(empty($p->price))--}}
             {{number_format($p->price,0)}}
            {{--{{--}}
             {{--$p->price--}}
             {{--}}--}}
            {{--@endif--}}
        </td>
        <td class="rmv form-control-sm font-weight-bold " style="color: red"
            onclick="rmv(this),countSum()">X
        </td>
        <td class="radif">1</td>
    </tr>
@endforeach