<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('football-api:fixtures')->hourly();
Schedule::command('football-api:fixture-events')->everyMinute();
Schedule::command('predictions:close-on-kickoff')->everyMinute();
