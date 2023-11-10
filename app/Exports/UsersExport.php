<?php

namespace App\Exports;

use App\Models\UserEnquiry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection,WithMapping,WithHeadings
{    
    use Exportable;

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }
   /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return[
            's no.',
            'Name',
            'Email',
            'Phone',
            'Message',
            'Created At',
        ];
    }

    public function map($data): array
    {   
         return $data;
    }
    // set the collection of members to export
    public function collection()
    {   
        $request = $this->request;  

        $items = UserEnquiry::query();
        $items = $items->get();
        
        return $items->map(function($data,$key){
            return [
                'id'       =>  $key + 1,
                'name'         =>  $data->name,
                'email'=>  $data->email,
                'phone'  =>  $data->phone,
                'message' =>  $data->message,
                'created_at' =>  $data->created_at,
            ];
        });
    }
}