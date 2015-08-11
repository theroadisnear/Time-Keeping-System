<?php
namespace App\CustomClass;

use Carbon\Carbon;

use DateTime;


class timeClass
{
    public static function timeCondition(DateTime $in, DateTime $out, Carbon $time_rendered)
    {
        if(($in < new DateTime(Carbon::parse('12:00:00')->toTimeString())) && ($out > new DateTime(Carbon::parse('13:00:00')->toTimeString())))
            {
                $new_time_rendered = Carbon::parse($time_rendered)->subHours(1)->toTimeString();

                return $new_time_rendered;
            }
            else if(($in < new DateTime(Carbon::parse('12:00:00')->toTimeString())) && ($out < new DateTime(Carbon::parse('13:00:00')->toTimeString())))
            {
                $minus = new DateTime(Carbon::parse($out->diff( new DateTime(Carbon::parse('12:00:00')->toTimeString()))->format("%H:%i:%s"))->toTimeString());
                $old = $time_rendered;
                $new_time_rendered = Carbon::parse($old->diff($minus)->format("%H:%i:%s"))->toTimeString();

                return $new_time_rendered;
                 
            }
            else if(($in < $hour = new DateTime(Carbon::parse('13:00:00')->toTimeString())) && ($in > new DateTime(Carbon::parse('12:00:00')->toTimeString())) && ($out > new DateTime(Carbon::parse('13:00:00')->toTimeString())))
            {
                $minus = new DateTime(Carbon::parse($hour->diff($in)->format("%H:%i:%s"))->toTimeString());
                $old = $time_rendered;
                $new_time_rendered = Carbon::parse($old->diff($minus)->format("%H:%i:%s"))->toTimeString();

                return $new_time_rendered;

            }
            else if(($in > new DateTime(Carbon::parse('12:00:00')->toTimeString())) && ($out < new DateTime(Carbon::parse('13:00:00')->toTimeString())))
            {
                $new_time_rendered = Carbon::parse('00:00:00')->toTimeString();

                return $new_time_rendered;
            }
            else
            {
                return $time_rendered;
            }
    }
}