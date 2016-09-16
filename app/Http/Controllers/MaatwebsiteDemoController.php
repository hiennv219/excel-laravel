<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Item;
use Input;
use DB;
use Excel;

use PHPExcel_IOFactory;
use PHPExcel_Cell;
use PHPExcel;


class MaatwebsiteDemoController extends Controller
{
    public function importExport(){
    	return view('importExport');
    }

    public function downloadExcel($type){
    	$data = Item::get()->toArray();
    	Excel::create('itsolutionstuff_example', function($excel) use ($data){
    		$excel->sheet('mySheet', function($sheet) use ($data){
    			$sheet->fromArray($data);
    		});
    	})->download($type);
    }

    public function importExcel(){
    	if(Input::hasFile('import_file')){
    		$path = Input::file('import_file')->getRealPath();
    		$data = Excel::load($path, function($reader){})->get();
    		if(!empty($data) && $data->count()){
    			header('Content-Type: text/html; charset=utf-8');
    			foreach($data as $key => $value){
    				foreach ($value as $v) {
    					$insert[] = [
    								'title' => $v->position,
    								'description' => $v->description
								];
    				}
    			}
    			if(!empty($insert)){
    				DB::table('items')->insert($insert);
    				dd('Insert Record Successfully');
    			}
    		}
    	}
    	return back();
    }


    public function getDataExcel()
    {
        header('Content-Type: text/html; charset=utf-8');
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();

            $objPHPExcel = PHPExcel_IOFactory::load($path);
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                $worksheetTitle     = $worksheet->getTitle();
                $highestRow         = $worksheet->getHighestRow();
                $highestColumn      = $worksheet->getHighestColumn();
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;

                for ($row = 1; $row <= $highestRow; ++ $row) {

                    $validate = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $validate = (int)$validate;
                    if($validate >= 1){
                        $get_cell = array();

                        for ($col = 0; $col < $highestColumnIndex; ++ $col) {

                            $cell = $worksheet->getCellByColumnAndRow($col, $row)->getValue();

                            //Kiem tra xem cell do co dung function khong.
                            //Neu co phai lay gia tri chu khong lay ham`
                            if(strstr($cell,'=')==true){
                                $cell = $worksheet->getCellByColumnAndRow($col, $row)->getOldCalculatedValue();
                            }

                            //Day ket qua cua tung cell vao array
                            array_push($get_cell,$cell);
                        }
                        echo $position = $get_cell[0];
                        echo $level =  $get_cell[4];
                        echo $question = $get_cell[5];
                        echo $result =  $get_cell[8];
                        echo $answer_1 = $get_cell[9];
                        echo $answer_2 = $get_cell[12];
                        echo $answer_3 = $get_cell[15];
                        echo $answer_4 = $get_cell[18];
                        echo $answer_5 = $get_cell[21];
                        echo $answer_6 = $get_cell[24];
                        echo $description = $get_cell[27];
                    }
                }
            }

        }
    }
}

