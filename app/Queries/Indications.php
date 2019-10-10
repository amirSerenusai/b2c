<?php

namespace App\Queries;

use DB;
use Illuminate\Support\Collection;

class Indications {

    protected $proc_id;

    /**
     * Indications constructor.
     *
     * @param $procedure_questions_ids
     */
    public function __construct($proc_id)
    {
        $this->proc_id = $proc_id;
    }

    public function get()
    {
        return $this->getFromQuestions()
            ->merge($this->getFromAnswers($this->getProcedureQuestionsIds()))
            ->unique();
    }

    /**
     * @return Collection
     */
    protected function getFromQuestions()
    {
        return DB::table('questions')
            ->select('indication as title')
            ->where('proc_id', '=', $this->proc_id)
            ->where('is_deleted', '=', 0)
            ->where('deleted_at', '=', null)
            ->get()
            ->filter(function($tag) {
                return substr($tag->title, -1) !== '*' and $tag->title ? $tag : null;
            })
            ->flatMap(function($tag) {
                return explode(',', trim($tag->title));
            })
            ->unique();
    }

    /**
     * @return array
     */
    protected function getProcedureQuestionsIds()
    {
        return DB::table('questions')
            ->select('id')
            ->where('proc_id', '=', $this->proc_id)
            ->where('is_deleted', '=', 0)
            ->where('deleted_at', '=', null)
            ->get()->map->id->toArray();
    }

    /**
     * @param $procedure_questions_ids
     *
     * @return Collection
     */
    protected function getFromAnswers($procedure_questions_ids)
    {
        return DB::table('answers')
            ->select('indication as title', 'question_id')
            ->where('is_deleted', '=', 0)
            ->where('deleted_at', '=', null)
            ->get()
            ->filter(function($tag) use ($procedure_questions_ids) {
                return $this->isRelaventTag($tag, $procedure_questions_ids) ? $tag : null;
            })
            ->flatMap(function($tag) {
                return explode(',', trim($tag->title));
            })->unique();
    }

    /**
     * @param $tag
     * @param $procedure_questions_ids
     *
     * @return bool
     */
    protected function isRelaventTag($tag, $procedure_questions_ids)
    {
        return in_array($tag->question_id, $procedure_questions_ids) and $tag->title and substr($tag->title, -1) !== '*';
    }

}