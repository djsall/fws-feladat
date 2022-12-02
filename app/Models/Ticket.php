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

	public function project(){
		return $this->belongsTo(Project::class);
	}
	public static function getPossibleStatuses() {
		return self::$statuses;
	}
	public function isOpen(){
		return $this->status == "open";
	}
	public function isInProgress(){
		return $this->status == "in_progress";
	}
	public function isClosed(){
		return $this->status == "closed";
	}
	public function getTranslatedStatus(){
		return self::$statuses[$this->status];
	}
	public function owner(){
		return $this->hasOne(User::class, "id", "owner_id");
	}
}
