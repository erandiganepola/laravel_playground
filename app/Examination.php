<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model {
    protected $table = "examinations";

    /**
     * Creator of the examination
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator() {
        return $this->belongsTo("App\\User", "created_by", "id");
    }

    /**
     * Students of this examination
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students() {
        return $this->belongsToMany("App\\User", "student_examination", "examination_id", "student_id")
            ->withPivot(["attempt"]);
    }
}
