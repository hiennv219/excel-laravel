<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
// use App\Http\Requests\Request;
use Excel, Input;

class ExcelController extends Controller
{
    public function getImport(){
        return view('excel.import');
    }

    public function postImport(Request $request){

        // header('Content-Type: text/html; charset=utf-8');
        // Excel::load(Input::file('file'), function($reader) {
        //     $reader->dd();

        //     // $reader->each(function($sheet){
        //     //         // var_dump($sheet->toArray());
        //     //     foreach($sheet->toArray() as $row){
        //     //         var_dump($row);
        //     //         echo "</br>";
        //     //     }
        //     // });
        // });

Excel::selectSheets('sheet1')->load();



$data = Excel::load('/storage/app/phong.xlsx', function($reader) use($data){
// foreach($reader as $key => $sheet) {
   //  $sheetTitle = $sheet->getTitle();
   // $reader->setActiveSheetIndex($key);
   //  if($sheetTitle === 'students') {
     // $reader->getActiveSheet()->setCellValue('A8', $data);
         //or $sheet->setCellValue('A8', $data);
     // }
  // }
})->get();





        return $data;
    }
}
