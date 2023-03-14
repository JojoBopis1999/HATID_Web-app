<?php
    session_start();
    require 'vendor/autoload.php';
    require '../database/dbcon.php';

    date_default_timezone_set('Asia/Manila');
    $datetime = date('Y-m-d_hia');

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Style\Alignment;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $spreadsheet = new Spreadsheet();
    $spreadsheet->setActiveSheetIndex(0);
    $worksheet = $spreadsheet->getActiveSheet();

    // Merge cells A1 to G1
    $worksheet->mergeCells('A1:G1');
    
    $spreadsheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(12);
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'JOURNEY LOGS');
    $sheet->getStyle('A1')->getFont()->setBold(true);
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->setCellValue('A2', 'LOG ID');
    $sheet->setCellValue('B2', 'Bus Driver');
    $sheet->setCellValue('C2', 'Bus');
    $sheet->setCellValue('D2', 'Route');
    $sheet->setCellValue('E2', 'Trip Start');
    $sheet->setCellValue('F2', 'Trip End');
    $sheet->getStyle('A2:G2')->getFont()->setBold(true);

    if (isset($_POST['print_logs'])) {
        $route_id = $_POST['choose_route'];
        $bus_id = $_POST['choose_bus'];
        $employee_uid = $_POST['choose_employee'];
        
        try {
            $trip_log_table = 'trip_logs';
            $trip_log_result = $database->getReference($trip_log_table)->getValue();
            if ($trip_log_result > 0) {
                $cellCount = 3;
                foreach($trip_log_result as $key => $row){
                    $bus_model_license = "";
                    $bus_table = "bus";
                    $bus_list = $database->getReference($bus_table)->getValue();
                    if($bus_list > 0){
                        foreach($bus_list as $bus_key => $bus_row){
                            if($row['bus_id'] == $bus_key){
                                $bus_model_license = $bus_row['bus_model']."|".$bus_row['license_plate'];
                            }
                        }
                    }

                    $route_name = "";
                    $route_table = "routes";
                    $route_name_result = $database->getReference($route_table)->getValue();
                    if($route_name_result > 0){
                        foreach($route_name_result as $route_key => $route_row){
                            if($route_key == $route_id){
                                $route_name = $route_row['route_name'];
                            }
                        }
                    }

                    $sheet->setCellValue('A'.$cellCount, $key);

                    $users = $auth->listUsers();
                    foreach($users as $user){
                        if($user->uid == $row['employee_uid']){
                            $sheet->setCellValue('B'.$cellCount, $user->displayName);
                        }
                    }

                    $sheet->setCellValue('C'.$cellCount, $bus_model_license);
                    $sheet->setCellValue('D'.$cellCount, $route_name);
                    $sheet->setCellValue('E'.$cellCount, $row['trip_start']);
                    $sheet->setCellValue('F'.$cellCount, $row['trip_end']);
                    $cellCount++;
                }

            $writer = new Xlsx($spreadsheet);
            $filename = 'JourneyLogs_'.$datetime.'.xlsx';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');

            $_SESSION['status'] = "Export to Excel successfully!!";
            header('Location:http://localhost/Shuttle_Bus_System/admin/journey_logs.php');
            exit(0);
            }else{
                $_SESSION['failed'] = "Error: There are no log recorded.";
                header('Location:http://localhost/Shuttle_Bus_System/admin/journey_logs.php');
                exit(0);
            }

            
        } catch (\Throwable $th) {
            $_SESSION['failed'] = "Error: ".$th->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/admin/journey_logs.php');
            exit(0);
        }
    }
?>