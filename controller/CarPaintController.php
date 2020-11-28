<?php
    require_once "helper.php";
    $helper = new Helper();

    if(!empty($_POST)){
        if($_POST['method'] == "NEW_PAINT_JOB"){
            $params = [
                "plate_no"  => htmlspecialchars($_POST['plate_no']),
                "current_color" => $_POST['current_color'],
                "target_color" => $_POST['target_color'],
            ];
            $result = $helper->insert("tbl_queue",$params);
            if($result){
                header("location: ../index.php");
            }
            else{
                header("location: ../paint_job.php");
            }
        }

        if($_POST['method'] == "MARK_AS_COMPLETE"){            
            $result = $helper->mark_complete($_POST['queue_id']);
            if($result){
                echo "Paint Job is Completed";
            }
            else{
                echo "Paint Job is Failed to Complete";
            }
        }

        if($_POST['method'] == "IN_PROGRESS"){            
            echo json_encode($helper->in_progress());
        }

        if($_POST['method'] == "QUEUE"){            
            echo json_encode($helper->queue());
        }

        if($_POST['method'] == "DASHBOARD"){            
            echo json_encode($helper->dashboard());
        }

    }
