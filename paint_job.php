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
        <li><a href="index.php">NEW PAINT JOB</a></li>
        <li><a href="paint_job.php" class="active">PAINT JOB</a></li>
    </ul>
    <br><br>
    <h1 class="center">Paint Jobs</h1>
    <div class="ml2">
        <h4>Paint Jobs in Progress</h4>
        <div style="display:flex;">
            <div style="margin-right: 30px;">
                <table id="table-progress" class="table">
                    <thead>
                        <tr>
                            <th>Plate No.</th>
                            <th>Current Color</th>
                            <th>Target Color</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            <!-- ------------------------------ -->
            <div>
                <table class="table2">
                    <thead>
                        <tr>
                            <th id="db-thead" colspan="3">SHOP PERFORMANCE</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #F0F0F0;">
                        <tr>
                            <td>Total Cars Painted</td>
                            <td>&nbsp;</td>
                            <td id="total-cars-painted"></td>
                        </tr>
                        <tr>
                            <td>Breakdown:</td>                    
                            <td>&nbsp;</td>                   
                            <td>&nbsp;</td>                   
                        </tr>
                        <tr>
                            <td>Blue:</td>     
                            <td>&nbsp;</td>               
                            <td id="breakdown-blue"></td>                    
                        </tr>
                        <tr>
                            <td>Red:</td>  
                            <td>&nbsp;</td>                  
                            <td id="breakdown-red"></td>                    
                        </tr>
                        <tr>
                            <td>Green:</td>
                            <td>&nbsp;</td>                    
                            <td id="breakdown-green"></td>                    
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <br>
        <h4>Paint Queue</h4>
        <table border="1" id="table-queue" class="table">
            <thead>
                <tr>
                    <th>Plate No.</th>
                    <th>Current Color</th>
                    <th>Target Color</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>

        
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        refresh_table();
        window.setInterval(function(){
            refresh_table();
        }, 5000);
        

        $(document).on('click','.btnCompleted',function(){
            var answer = confirm("Mark this as Completed?");
            var queue_id = $(this).data("queue-id");
            if(answer){
                $.ajax({
                    type: "POST",
                    data: {
                        queue_id : queue_id,
                        method : 'MARK_AS_COMPLETE'
                    },
                    url: "controller/CarPaintController.php",
                    success:function(data){
                        console.clear();
                        alert(data);  
                        $(this).closest('tr').remove();                              
                    }
                });
            }
            
        });
    });
    
    function refresh_table(){
        $.ajax({
            type: "POST",
            data: {
                method : 'IN_PROGRESS'
            },
            url: "controller/CarPaintController.php",
            success:function(data){
                console.clear();
                data = JSON.parse(data);    
                in_progress(data)            
            }
        });
        $.ajax({
            type: "POST",
            data: {
                method : 'QUEUE'
            },
            url: "controller/CarPaintController.php",
            success:function(data){
                console.clear();
                data = JSON.parse(data);    
                queue(data)            
            }
        });

        $.ajax({
            type: "POST",
            data: {
                method : 'DASHBOARD'
            },
            url: "controller/CarPaintController.php",
            success:function(data){
                console.clear();
                data = JSON.parse(data);    
                console.log(data);
                dashboard(data[0])            
            }
        });
    }
    function in_progress(data){        
        $("#table-progress > tbody").empty();
        for (let index = 0; index < data.length; index++) {
            let newRow = `
                <tr>
                    <td>${data[index]['plate_no']}</td>
                    <td>${data[index]['current_color'].charAt(0).toUpperCase() + data[index]['current_color'].slice(1)}</td>
                    <td>${data[index]['target_color'].charAt(0).toUpperCase() + data[index]['target_color'].slice(1)}</td>
                    <td style="text-align: center;">
                        <button class="btnCompleted" data-queue-id="${data[index]['id']}">Mark as Completed</button>
                    </td>
                </tr>
            `;
            $("#table-progress > tbody").append(newRow);
        }
    }
    function queue(data){    
         
        $("#table-queue > tbody").empty();
        for (let index = 0; index < data.length; index++) {
            let newRow = `
                <tr>
                    <td>${data[index]['plate_no']}</td>
                    <td>${data[index]['current_color'].charAt(0).toUpperCase() + data[index]['current_color'].slice(1)}</td>
                    <td>${data[index]['target_color'].charAt(0).toUpperCase() + data[index]['target_color'].slice(1)}</td>
                </tr>
            `;
            $("#table-queue > tbody").append(newRow);
        }
    }

    function dashboard(data)
    {
        $("#total-cars-painted").text(data.total);
        $("#breakdown-blue").text(data.blue);
        $("#breakdown-red").text(data.red);
        $("#breakdown-green").text(data.green);
    }
</script>
</html>