{{--@hasanyrole('user')--}}
@if(isset($query))
    @foreach($query as $q)
        <tr id="trBody">
            <td>{{$q->seq}}</td>
            <td id="vchnumValue">{{$q->vchnum}}</td>
            <td>
                <input type="checkbox" id="inpCheckbox" class="checkbox icheckbox_flat-blue icheckbox_square "
                       style=";margin:auto;text-align: center;">
            </td>
            <td id="partcodeValue">{{$q->partcode}}</td>
            <td style="max-width: 400px;float: right">{{$q->partname}}</td>
            <td>{{$q->grp}}</td>
            <td>{{(int)$q->price}}</td>
            <td id="tdInutCnt" style=";margin:0;padding-left: 0;padding-right: 0;">
                <input id="cntValue" type="number" min="1" class=""
                       style="text-align: center;max-width: 50px;border: 0;margin:0;padding: 0;" autocomplete="off"
                       @if(isset($q->cnt))
                       value="{{$q->cnt}}"
                        @endif
                >
            </td>
            <td>
                <input type="button" class="btn btn-sm btn-primary"
                       onclick="saveCount(
                           $(this).parent().parent().find('#vchnumValue').text(),
                           $(this).parent().parent().find('#partcodeValue').text(),
                           $(this).parent().parent().find('#cntValue').val(),
                           $(this).parent().parent().find('#stockRefValue').text(),
                           $(this).parent().parent().find('#opStockRefValue').text()
                           )"
                       value="save">
            </td>
            <td id="qtyValue" style="text-align: center">
                {{--@hasanyrole('all_principals|admin')--}}
                {{(int)$q->qty}}
                {{--@endhasanyrole--}}
            </td>
            <td>{{$q->pDate}}</td>
            <td id="stockRefValue">{{$q->stockRef}}</td>
            <td id="opStockRefValue">{{$q->opStockRef}}</td>
            <td id="shelf2" style="width:230px ;display: inline-block;" id="tdShelf">

                <input id="inpShelf2" type="number" min="1" class=""
                       style="top:2px;color: red;text-align: center;max-width: 60px;border: 0;margin:0;padding: 0;display: inline-block"
                       autocomplete="off"
                       @if(isset($q->shelf))
                       value="{{$q->shelf}}"
                        @endif
                >
                {{--</td>--}}
                {{--<td style="color: red">--}}
                <input id="saveShelf" type="button" class="btn btn-primary"
                       style=";display: inline-block;" type="button" class="btn btn-sm btn-primary"
                       data-partref="{{$q->partref}}"
                       data-partcode="{{$q->partcode}}"
                       data-partname="{{$q->partname}}"
                       data-opStockRef="{{$q->opStockRef}}"
                       {{--data-barcode="{{$q->barcode}}"--}}
                       {{--onclick="console.log($(this).attr('data-opStockRef'))"--}}
                       onclick="SavePlace(
                       $(this).attr('data-partref'),
                       $(this).attr('data-partcode'),
                       $(this).attr('data-partname'),
                       $(this).attr('data-opStockRef'),
                       $(this).parent('td#shelf2').children('#inpShelf2').val(),
                       'barcode'
                       )"
                       value="تغییر شماره قفسه">
                {{--<input style="display: inline-block" type="button" class="btn btn-sm btn-primary"--}}
                {{--onclick="updateShelf(--}}
                {{--$(this).parent().parent().find('#vchnumValue').text(),--}}
                {{--$(this).parent().parent().find('#partcodeValue').text(),--}}
                {{--$(this).parent().parent().find('#cntValue').val(),--}}
                {{--$(this).parent().parent().find('#stockRefValue').text(),--}}
                {{--$(this).parent().parent().find('#opStockRefValue').text()--}}
                {{--)"--}}
                {{--value="تغییر شماره قفسه">--}}

            </td>
        </tr>

    @endforeach
@endif
{{--@endhasanyrole--}}