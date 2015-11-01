<?php

/**
 * @author: Renier Ricardo Figueredo
 * @mail: aprezcuba24@gmail.com
 */
namespace CULabs\IlluminateBundle\Bridge\Scheduling;

use Illuminate\Console\Scheduling\Schedule;

interface ScheduleKernelInterface
{
    public function schedule(Schedule $schedule);
}