<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {
	public static array $statuses = [
		"open"        => "Aktív",
		"in_progress" => "Folyamatban",
		"closed"      => "Lezárva"
	];

	use HasFactory;

	public static function getPossibleStatuses() {
		return self::$statuses;
	}
}
