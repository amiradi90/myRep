@if(isset($query))
    @foreach($query as $q)
        <tr id="trBody">

            <td>{{$q->seq}}</td>
            <td>{{$q->docno}}</td>
            <td>
                <input type="checkbox" id="inpCheckbox" class="checkbox icheckbox_flat-blue icheckbox_square " style=";margin:auto;text-align: center;">
            </td>
            <td>{{$q->partcode}}</td>
            <td style="max-width: 400px">{{$q->partname}}</td>
            <td>{{$q->grp}}</td>
            <td>{{(int)$q->price}}</td>
            <td>{{(int)$q->Qty}}</td>
            <td>{{$q->date}}</td>
            <td>{{$q->from}}</td>
            <td>{{$q->to}}</td>
        </tr>

    @endforeach
@endif