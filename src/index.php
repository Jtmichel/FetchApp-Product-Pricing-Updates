<!DOCTYPE html>
<html>
<head>
    <style>
        table{
            text-align: left;
            border-collapse: collapse; 
        }
        th{
            border-bottom: 2px solid #ccc;
        }
        tr{

        }
        table td{
            border-bottom: 1px solid #ccc;
            display:table-cell;
        }
        table td, table th{
            padding: 10px;            
        }
        form div label{
            min-width: 120px;
            display:inline-block;
        }
        form > div{
            margin: 10px 0px;
        }
    </style>   
</head>
<body>
<h2>Bulk Pricing Updater</h2>
<form action="process.php" method="post">
    <div>
        <label>FetchApp Key</label><input type="text" name="fetchapp_key" id="fetchapp_key"/></br>
    </div>
    <div>
        <label>FetchApp Token</label><input type="text" name="fetchapp_token" id="fetchapp_token"/></br>
    </div>
    <div>
        <label>Old Price</label><input type="text" name="old_price" id="old_price"/></br>
    </div>
    <div>
        <label>New Price</label><input type="text" name="new_price" id="new_price"/></br>
    </div>
    <input type="hidden" name="process" value="true"/>
    <button type="submit">Submit</button>
</form>

</table>
</body>


</html>
