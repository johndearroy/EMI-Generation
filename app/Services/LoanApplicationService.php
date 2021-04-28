<?php


namespace App\Services;


use Illuminate\Database\Eloquent\Collection;

class LoanApplicationService
{
    /**
     * @param Collection $data
     * @return Collection|\Illuminate\Support\Collection
     * EMI payment or due date will be 1 month from the date and time admin has approved the loan
     * application and payment end date will be 1 month from the payment date
     */
    public function prepareApplicationData(Collection $data)
    {
        return $data->map(function ($item) {
            if ($item->status === 'Approved') {
                $installments = [];
                for ($i = 1; $i < $item->duration + 1; $i++) {
                    $installment = [
                        'serial' => $i,
                        'title' => $this->formatTitle($i), //$i + 1 . ' Installment'
                        'total_amount' => $item->emi,
                        'payment_date' => $item->created_at->addMonths($i),
                        'payment_end_date' => $item->created_at->addMonths($i + 1),
                    ];
                    array_push($installments, $installment);
                }
                return $item = collect($item)->put('emi_details', $installments);
            } else {
                return collect($item);
            }
        });
    }

    /**
     * @param $number
     * @return string
     * For generating the title
     */
    private function formatTitle($number) {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');

        if ((($number % 100) >= 11) && (($number%100) <= 13))
            return $number. 'th';
        else
            return $number. $ends[$number % 10];
    }
}
