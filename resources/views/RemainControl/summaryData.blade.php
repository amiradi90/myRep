@if(!$data==null)
    @foreach($data as $d)
        <tr id="trData" class="trData">
            <td></td>
            <td id="tdPartcode">{{$d->partcode}}</td>
            <td id="tdBarcode">{{$d->barcode}}</td>
            <td class="" style="max-width: 220px;">{{$d->name}}</td>
            <td id="tdRemain2" class="">{{$d->remain2}}</td>
            {{--<td id="tdSave" class="tdSave" style="width:35px;">--}}
            </td>
            @hasanyrole('admin|all_principals')
            <td id="tdRemain" class="tdRemain tdInpRemain2">
                {{($d->remain)}}
            </td>
            @endhasanyrole
            <td>{{$d->publisher}}</td>
            <td>{{$d->grpid}}</td>
            <td>{{$d->grp}}</td>
            <td id="tdStock">{{$d->stock}}</td>
            <td id="tdDocremainid">{{$d->docremain_id}}</td>
            <td>{{$d->pickdate}}</td>
            <td>{{$d->pickdateday}}</td>
            <td id="tdId" id="">{{$d->id}}</td>
            {{--<td id="remainControl" style="display: none"> {{$d->remain}}</td>--}}
        </tr>
    @endforeach

@endif
