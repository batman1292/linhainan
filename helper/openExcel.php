<html>

    <body>

        <form name="form1">
            <input type=button onClick="openExcelFile('.xlxs')" value="Open File">
            <br><br>
        </form>
        <script src="jquery-1.11.1.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                window.open("linhainan.xlsx", "", "");
                window.location = '../admin/view/export_excel.php';
            });

        </script>
    </body>
</html>