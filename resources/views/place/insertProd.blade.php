@foreach($result as $p)
    <tr class="trLast" style=";"
        onclick="$('.trLast').children().css('background-color','');$(this).find('.rmv,.price0,.grp0,.tedad,.barcode0,.partcode0,.name0,.radif').css('background-color','#5B89FF')">
        <td class="partref0" id="partref0" style="display: none">{{$p->partref}}</td>
        <td class="barcode0" id="barcodebarcode0" style="">{{$p->barcode}}</td>
        <td class="partcode0" style="" ondblclick="showRemain(this.id)" id="{{$p->partcode}}">{{$p->partcode}}</td>
        <td class="partname0" id="partname0">{{$p->partname}}</td>
        <td id="shelf" class="tedad form-control-sm " style="padding: 0;margin: 0">

            <input id="inpShelf" class=" input-group-text" min="1" pattern="[1-9]*" tabindex="-1"
                   type="number" class="form-control-sm"
                   style="height: 100%;width: 70px;margin: 0;color:red;"
                   @if((int)!empty($p->shelf))
                   value="{{$p->shelf}}"
                    @endif
            >

        </td>
        <td class="form-control-sm font-weight-bold " style="color: red">
            <input id="saveBtn" type="button" class="btn btn-primary" onclick="SavePlace(
                $(this).parent().parent().children('#partref0').text(),
                $(this).parent().parent().children('.partcode0').text(),
                $(this).parent().parent().children('.partname0').text(),
                $('#stockid').text(),
                $(this).parent().parent().children('td#shelf').children('#inpShelf').val(),
                $(this).parent().parent().children('.barcode0').text()
            )" value="save">
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
        <td></td>
        <td class="radif">1</td>
    </tr>
@endforeach