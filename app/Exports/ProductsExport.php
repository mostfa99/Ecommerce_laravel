<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ProductsExport implements FromQuery, WithMapping, WithColumnFormatting, WithHeadings
{
    protected $query;
    public function setQuery($query)
    {
        $this->query = $query;
    }
    /**
     * @return Builder
     */
    public function query()
    {
        return $this->query;
    }

    public function map($product): array
    {
        return [
            'name' => $product->name,
            'category name' => $product->category->name,
            'price' => $product->price,
            'status' => $product->status,
        ];
    }
    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_CURRENCY_EUR,
        ];
    }
    public function headings(): array
    {
        return [
            'Name',
            'Category Name',
            'Price',
            'Status',
        ];
    }
}
