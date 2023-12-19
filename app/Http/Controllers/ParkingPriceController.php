<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ParkingPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParkingPriceController extends Controller{


    public function index($from_date = '', $to_date = ''):array{
        if( empty( $from_date ) ){
            $from_date = now()->add('3 hours');
        }

        if( empty( $to_date ) ){
            $to_date = Carbon::parse($from_date)->add('2 days')->add('3 hours');
        }

        if( $to_date < $from_date ) return [];

        try{
            $start = Carbon::parse($from_date);
            $end = Carbon::parse($to_date);
        }
        catch(\Exception $e){
            return [];
        }
        
        $list_of_dates = [];

        $prices = ParkingPrice::get()->toArray();

        for ($date = $start; $date->lte($end); $date->addDay()) {

            $season_and_day_type = $this->getSeasonAndDayType($date->toDateString());

            $search = ['day_type'=>$season_and_day_type['day_type'], 'season'=>$season_and_day_type['season']];

            foreach($prices as $k => $v) {

                if ( $search === array_intersect_assoc($v, $search) ) {

                    if( $prices[$k]['discount'] > 0 ){
                        $day_price = $prices[$k]['price'] * (100 - $prices[$k]['discount']);
                    } else {
                        $day_price = $prices[$k]['price'];
                    }

                    $list_of_dates[$date->toDateString()]['day_price'] = $day_price;
                    $list_of_dates[$date->toDateString()]['season'] = $season_and_day_type['season'];
                    $list_of_dates[$date->toDateString()]['day_type'] = $season_and_day_type['day_type'];

                    break;
                }
            }

        }

        return ['list_of_dates' => $list_of_dates, 'total_price' => number_format((float)array_sum(array_column($list_of_dates,'day_price')), 2, '.', '')];

    }


    public function getSeasonAndDayType($date) {
        $parsedDate = Carbon::parse($date);
        $month = $parsedDate->month;

        ## Determine season based on the month. Assuming only two 'seasons' for now:
        switch ($month) {
            case 10:
            case 11:
            case 12:
            case 1:
            case 2:
            case 3:
                $season = 'winter';
                break;
            default:
                $season = 'summer'; // by default 'summer' price
        }
    
        ## Determine day type (weekday/weekend/holiday)
        ## This would be automated - pulled from the DB or through the API:
        ## https://www.gov.uk/bank-holidays
        $bank_holidays_2023 = ['2023-12-25', '2023-12-26'];
        $bank_holidays_2024 = ['2024-01-01', '2024-03-19', '2024-04-01', '2024-05-06', '2024-05-27', '2024-08-26', '2024-12-25', '2024-12-26'];
        $bank_holidays_2025 = ['2025-01-01', '2025-04-18', '2025-04-21', '2025-05-05', '2025-05-26', '2025-08-25', '2025-12-25', '2025-12-26'];
        
        if( in_array($parsedDate->toDateString(), $bank_holidays_2023) ||
            in_array($parsedDate->toDateString(), $bank_holidays_2024) ||
            in_array($parsedDate->toDateString(), $bank_holidays_2025)
        ){
            $dayType = "bank_holiday";
        } else {
            $dayOfWeek = $parsedDate->dayOfWeek;
            $dayType = ($dayOfWeek >= Carbon::MONDAY && $dayOfWeek <= Carbon::FRIDAY) ? 'weekday' : 'weekend';
        }

        return [
            'season' => $season,
            'day_type' => $dayType
        ];
    }
}
