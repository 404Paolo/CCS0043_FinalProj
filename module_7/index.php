<?php
    require('getrecords.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profiles</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
            margin: 5px;
        }
        a{
            display: block;
            border: 1px solid black;
            border-radius: 5px;
            padding: 5px;
            padding-top: 15px;
            height: 30px;
            width: 200px;
            text-align: center;
            text-decoration: none;
            margin: 5px;
            background-color: #4CAF50;
            color: white;
        }
        img{
            height: 80px;
        }  
    </style>
</head>
<body>
    <a href="addnew.php">Add New Student Profile</a>
    <table>
        <thead>
            <th>ID</th>
            <th>Image</th>
            <th>ID Number</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Sex</th>
            <th>Date Created</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
                // Loop through the array
                foreach($rows as $row):
            ?>
                    <tr>
                        <td><?php echo $row['id'];?></td>
                <?php
                    // Check if image is null
                    if($row['img'] == null):
                ?>
                        <td><img src="<?php echo 'images/nofile.png';?>"></td>
                <?php
                    else:
                ?>
                        <td><img src="<?php echo 'images/'.$row['img'];?>"></td>
                <?php
                    endif;
                ?>
                        <td><?php echo $row['idnum'];?></td>
                        <td><?php echo $row['lname'];?></td>
                        <td><?php echo $row['fname'];?></td>
                        <td><?php echo $row['mname'];?></td>
                        <td><?php echo $row['sex'];?></td>
                        <td><?php echo $row['datecreated'];?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id'];?>">Edit</a>
                            <a onclick="del(<?php echo $row['id'];?>)">Delete</a>
                        </td>
                    </tr>
            <?php
                // End loop
                endforeach;
            ?>
        </tbody>
    </table>

    <script type="text/javascript">
        function del(id){
            if(confirm('Sure to Delete?')){
                window.location.href='delete.php?id='+id;
            }else{
                window.location.href='index.php';
            }
        }
    </script>
</body>
</html>