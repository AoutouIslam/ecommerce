<?php

namespace App\Exports;

use App\Models\ArticleAcheter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
class ArticleAcheterExport implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */


    public function headings(): array
        {
        return[
            'ref_article',
            'nom_article',
            'category' ,
            'demension' ,
            'color' ,
            'prix_achat' ,
            'prix_vente',
            'misc' ,
        ];
    }


    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }


    public function collection()
    {
        $request = $this->request;
        return ArticleAcheter::where('commande_id',$request)->get(array('ref_article','nom_article','category','demension','color','prix_achat','prix_vente','misc'));

    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('E2')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setRGB('0e0707');

            },
        ];
    }
}
