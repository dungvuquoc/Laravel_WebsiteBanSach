<?php

namespace App\Http\Controllers;

use App\Exports\CategoryExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class ExportController extends Controller
{
    public function export() {
        return Excel::download(new CategoryExport, 'Category.xlsx');
//        $customer_data = DB::table('categories')->get()->toArray();
//        $customer_array[] = array('Id', 'Name', 'City', 'Postal Code');
//        foreach($customer_data as $customer)
//        {
//            $customer_array[] = array(
//                'Id'  => $customer->id,
//                'Name'   => $customer->name,
//                'Created At'    => $customer->created_at,
//                'Updated At'  => $customer->updated_at
//            );
//        }
//        Excel::create('CategoryData', function($excel) use ($customer_array){
//            $excel->setTitle('CategoryData');
//            $excel->sheet('CategoryData', function($sheet) use ($customer_array){
//                $sheet->fromArray($customer_array, null, 'A1', false, false);
//            });
//        })->download('xlsx');
    }
}
