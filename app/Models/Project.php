<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
	use HasFactory;

	public static array $statuses = [
		"awaiting_development" => "Fejlesztésre vár",
		"in_progress"          => "Folyamatban",
		"completed"            => "Kész"
	];

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function tickets(){
		return $this->hasMany(Ticket::class);
	}

	public function contacts() {
		return $this->belongsToMany(User::class);
	}

	public function getTranslatedStatus() {
		return self::$statuses[$this->status];
	}

	public function isPending(){
		return $this->status == "awaiting_development";
	}

	public function isInProgress(){
		return $this->status == "in_progress";
	}

	public function isCompleted(){
		return $this->status == "completed";
	}

	public static function getPossibleStatuses() {
		return self::$statuses;
	}
}
