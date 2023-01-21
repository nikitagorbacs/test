<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    {{-- @foreach ($data as $item)
        <img src="{{ $item['urls']['small'] }}" alt="" width="200px" height="300px">
    @endforeach --}}
    <form action="{{ route('test.result') }}" method="POST">
        @csrf
        <form id="myform">
            <input type="button" value="+" id="add1" class="plus" />
            <input type="text" id="qty1" value="1" class="qty" />
            <input type="button" value="-" id="minus1" class="minus" /><br /><br />
        </form>
        {{-- <button type="submit">Submit</button>
        <input type="text" hidden value="1">
        <button name="delete" onclick="location.href = '/test/result';" type="button">delete</button> --}}
    </form>
</body>
<script>
    $(function() {
        $(".plus").click(function() {
            var currentVal = parseInt($(this).next(".qty").val());
            if (currentVal != NaN) {
                $(this).next(".qty").val(currentVal + 1);
            }
        });

        $(".minus").click(function() {
            var currentVal = parseInt($(this).prev(".qty").val());
            if (currentVal != NaN) {
                if (currentVal > 1) {
                    $(this).prev(".qty").val(currentVal - 1);
                }
            }
        });
    });
</script>

</html>
