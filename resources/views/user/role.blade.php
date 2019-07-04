<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>users role permission</title>
    <script src="{{asset(url('js/jquery.min.js'))}}"></script>
    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>
    <link rel="stylesheet" href={{asset(url('css/jquery-confirm.min.css'))}}/>
    {{--<script src='{{asset(url('js/jquery-confirm.min.js'))}}'></script>--}}
    {{--<link rel="stylesheet" href={{asset(url('css/font-awesome.min.css'))}}/>--}}

    <script>
        /* if the page has been fully loaded we add two click handlers to the button */
        $(document).ready(function () {
            /* Get the checkboxes values based on the class attached to each check box */
            $("#buttonClass").click(function () {
                getValueUsingClass();
            });

            /* Get the checkboxes values based on the parent div id */
            $("#buttonParent").click(function () {
                getValueUsingParentTag();
            });
        });

        function getValueUsingClass() {
            /* declare an checkbox array */
            var chkArray = [];

            /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
            $(".chk:checked").each(function () {
                // chkArray.push($(this).data('text'));
                chkArray.push($(this).val());
            });

            /* we join the array separated by the comma */
            var selected;
            selected = chkArray.join(',');

            /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
            if (selected.length > 0) {
                alert("You have selected " + selected);
            } else {
                alert("Please at least check one of the checkbox");
            }
        }

        function getValueUsingParentTag() {
            var chkArray = [];

            /* look for all checkboes that have a parent id called 'checkboxlist' attached to it and check if it was checked */
            $("#checkboxlist input:checked").each(function () {
                chkArray.push($(this).val());
            });

            /* we join the array separated by the comma */
            var selected;
            selected = chkArray.join(',');

            /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
            if (selected.length > 0) {
                alert("You have selected " + selected);
            } else {
                alert("Please at least check one of the checkbox");
            }
        }
    </script>

</head>
<body>


<div id="checkboxlist">
    <div><input type="checkbox" value="1" class="chk" data-text="admin">admin</div>
    <div><input type="checkbox" value="3" class="chk" data-text="all_principals">all_principals</div>
    <div><input type="checkbox" value="4" class="chk" data-text="b1admin"> b1admin</div>
    {{--<div><input type="checkbox" value="4" class="chk"> Value 4</div>--}}
    {{--<div><input type="checkbox" value="5" class="chk"> Value 5</div>--}}
    <div>
        <input type="button" value="Get Value Using Class" id="buttonClass">
        <input type="button" value="Get Value Using Parent Tag" id="buttonParent">
    </div>
</div>

</body>
</html>
