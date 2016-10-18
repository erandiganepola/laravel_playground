<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model {
    protected $table = 'results';

    /**
     * Student who owns the results
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student() {
        return $this->belongsTo("App\\User", "student_id", "id");
    }

    /**
     * Examination of the result
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function examination() {
        return $this->belongsTo("App\\Examination", "examination_id", "id");
    }

    /**
     * Attempt Number
     * @return mixed
     */
    public function getAttempt() {
        return $this->attempt;
    }
}
