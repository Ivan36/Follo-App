<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    var x = 1;
    $("#newbtn").click(function () {
     $("table tr:first").clone().find("input").each(function () {
         $(this).val('').attr({
             'id': function (_, id) {
                 return id + x
             },
                 'name': function (_, name) {
                 return name + x
             },
                 'value': ''
         });
     }).end().appendTo("table");
     x++;
 });

 $(document).on('click', 'button.deletebtn', function () {
     $(this).closest('tr').remove();
     return false;
 });
});
</script>
</head>
<body>
<table>
    <tr>
        <td>
            <button type="button" class="deletebtn" title="Remove row">X</button>
        </td>
        <td>
            <input type="text" id="txtTitle" name="txtTitle">
        </td>
        <td>
            <input type="text" id="txtLink" name="txtLink">
        </td>
    </tr>
</table>
<button id="newbtn">Add new Row</button>
</body>
</html>