<?php

//include 'dbFunctions.php';
include_once '..\src/model/Repository.php';

if(isset($_POST['table']))
{
    $tableName = $_POST['table'];
}

//if (isset($_POST['customerName']))
//{
//    $tableName = $_POST['customerName'];
//}

?>

<html>
<head>
    <title>PHP Demo : Read</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <h1>Select Table</h1>

    <select name="table" id="ddTable">
        <option value="Customer">Customers</option>
        <option value="Booking">Booking</option>
    </select>

    <input type="submit" value="Submit">
    <p>
        <?php
        //get all the table names
        if (isset($tableName)){
            $db = new Repository();
            $results = $db->getAll($tableName);
        }

        if ($results)
        {
            //Hopefully if the results have been the right PDO type we should be able
            //to extract the column names with ease.
            $columns = empty($results) ? array() : array_keys($results[0]);
            $idColumn = $columns[0];

            $tableString = '<table border="1"><tr>';
            $inputString = '';
            $insertString = '';
            foreach($columns as $column)
            {
                $tableString .= '<th>'.$column.'</th>';
                $inputString .= '<th>'.$column.'</th>';
                $insertString .= '<td><input type=\'text\' name=\''.$column.'\'/></td>';

            }
            echo $tableString;

            foreach($results as $row)
            {
                echo '<tr>';

                foreach($row as $cell)
                {
                    echo '<td>'.$cell.'</td>';
                }
            }
            echo '</table>';
        }
        ?>
    </p>

</form>
<!--<form action="--><?php //echo $_SERVER['PHP_SELF']; ?><!--" method="post">-->
<!--    <label for="customer_Name">FirstName</label>-->
<!--    <input type="text" id="customer_Name" name="customerName">-->
<!--    <input type="submit" value="go"/>-->
<!---->
<!--    --><?php
//    $abc = new Repository();
//    $abc->showCustomer('John');
//    ?>
<!--</form>-->

</body>
</html>
