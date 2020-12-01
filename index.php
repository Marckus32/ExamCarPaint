<?php 
    require_once "controller/connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juan's Auto Paint</title>
    <link rel="stylesheet" href="resources/css/style.css">
</head>
<body>
    <h1 class="header">JUAN'S AUTO PAINT</h1>
    <ul>
        <li><a href="index.php" class="active">NEW PAINT JOB</a></li>
        <li><a href="paint_job.php">PAINT JOB</a></li>
    </ul>
    <br><br>
    <h1 class="center">New Paint Job</h1>
    <br>
    <div class="center">
        <img src="resources/images/gray.png" id="current-car-image">
        <img src="resources/images/arrow.png" height="40" style="margin-bottom:50px;">
        <img src="resources/images/gray.png" id="target-car-image">
    </div>

    <div class="ml">
        <form action="controller/CarPaintController.php" method="post">
            <input type="hidden" name="method" value="NEW_PAINT_JOB">
            <h4>Car Details</h4>
            
            <table style="width: 100%;" >
                <tr>
                    <td>Plate No.</td>
                    <td><input type="text" class="form-control" name="plate_no" required autocomplete="off" style="float:right; width:97%;"></td>
                </tr>
                <tr>
                    <td>Current Color</td>
                    <td>
                        <select name="current_color" class="form-control" onchange="change_color('current-car-image',this.value)" style="float:right; width:100%;">
                            <option value=""></option>
                            <option value="red">Red</option>
                            <option value="blue">Blue</option>
                            <option value="green">Green</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Target Color</td>
                    <td>
                        <select name="target_color" class="form-control" onchange="change_color('target-car-image',this.value)" style="float:right; width:100%;">
                            <option value=""></option>
                            <option value="red">Red</option>
                            <option value="blue">Blue</option>
                            <option value="green">Green</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" class="btn-submit">Submit</button></td>
                </tr>
            </table>
            
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        
    });
    function change_color(id,color)
    {                       
        if(color == ""){
            color = "gray";
        }
        let src = `resources/images/${color}.png`;
        $(`#${id}`).attr("src",src);
    }
</script>
</html>