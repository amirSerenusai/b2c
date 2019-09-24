<?php

namespace App;

use App\Exceptions\InvalidKeysException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use function Stringy\create as s;
use Stringy\Stringy;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

/**
 * Class ExpressionParser
 * @package App
 */
class ExpressionParser
{
    private $procedure;
    private $keys;
    protected $display_groups;
    protected $names;
    const CONDITION_ERROR_MESSAGE = 'Your request may not be processed due to an error in the system.';

    /**
     * ExpressionParser constructor.
     * @param Procedure $procedure
     * @param $names
     */
    public function __construct($procedure,$names=null)
    {

        $this->procedure = $procedure ;
        $this->names = $names ;
        $this->keys = $this->procedure->keys();

        // $request = new Request();
        // //info(print_r($request->session(),1));
        ////info(print_r(Request::input('indicationSiblings'),1));
        //  //info("indicationSiblingsEND");
        // //info(print_r($names,1));
        $this->display_groups = $this->procedure->displayGroups();
    }

    /**
     * Convert condition to values from keys and evaluate as php code
     *
     * @param $expression
     * @param Collection|array $keys the current keys for this test
     * @param object $source the question/answer that contains this expression
     *
     * @return bool
     */
    public function parse($expression, $keys = [], $source = null)
    {
        //info('expression');
        //info($expression);
        $formatted_condition = $expression;

        $this->allCurrentKeys($keys)
            ->each(/**
             * @param $value
             * @param $key
             */
                function ($value, $key) use ( &$formatted_condition) {
                    $key = str_replace("*","",$key);

                    $formatted_condition = trim( str_replace("@{$key}" , $value , " ".$formatted_condition ));//  $formatted_condition->regexReplace("@$key", $value);

                });
        //info('FORMATED expression');
        //info($formatted_condition);

        preg_match_all('/@\w+/', $formatted_condition, $matches);

        if (!empty($matches[0])) {


            $unrecognized = implode(', ', $matches[0]);
            $message = 'False condition, unrecognized keys: ' . $unrecognized;

            throw new InvalidKeysException($message, 406, null, $formatted_condition, $expression, $source);
        }

        try {
            //info('456456 456456');
            //info(eval("return {$this->formatCondition($formatted_condition)};" ) );
            //info('llll');
            return eval("return {$this->formatCondition($formatted_condition)};");

        } /** @noinspection PhpFullyQualifiedNameUsageInspection */ catch (\Throwable $exception) {

            throw new InvalidKeysException($exception->getMessage(), 406, null, $formatted_condition, $expression, $source);
        }
    }

    /**
     * @param string $condition
     *
     * @return string
     */
    protected function formatCondition($condition)
    {
        //info( "condition" );
        //info( $condition );
        /** @var Stringy $condition */
        $condition = s($condition);


        $condition = $condition
            ->replace(' = ', ' == ')
            ->replace('_no', Questionnaire::VAS_NO)
            ->replace('_unknown', Questionnaire::VAS_UNKNOWN)
            ->replace('_void', Questionnaire::VAS_VOID)
            ->replace('_more', Questionnaire::VAS_MORE)
            ->replace('_less', Questionnaire::VAS_LESS)
            ->replace('_equiv_indication', 8)
            ->replace('_med_indication', 3)
            ->replace('_no_indication', 1)
            ->replace('_low_indication', 2)
            ->replace('_high_indication', 4)
            ->trim()
            ->__toString();

        return $condition;
    }

    /**
     * @param array|Collection $keys
     *
     * @return Collection
     */
    public function allCurrentKeys($keys)
    {
        return $this->keys
            ->merge($keys)
            ->sortByDesc(function ($value, $key) {
                return strlen($key);
            });
    }

    /**
     * @param Collection $keys
     * @param Collection $indications
     *
     * @return Collection
     */
    public function generateSystemKeys($keys, $indications){
        //$Time_temp = microtime(true);

        if (!$keys || $keys->isEmpty()) return collect();
        // giving initial void keys , so system will know to parse all types of conditions, even if the indicaitons does not exist.
        foreach ($this->procedure->indications() as $indication => $value) {
            $indication = str_replace("*","",$indication);
            $keys->put('#score ' . $indication, $value);
            $keys->put('#score', $value);
            $keys->put('#decision ' . $indication, '_void');
            $keys->put('#decision', '_void');
        }

        foreach ($indications as $indication => $properties) {
            $indication = str_replace("*","",$indication);
            $keys->put('#score ' . $indication, $properties['weight']);
            $keys->put('#score', $indications->max('weight'));
            if (isset($properties['score'])) {
                $keys->put('#decision ' . $indication, $this->decisionToConst($properties['score']['decision_code']));
                $keys->put('#decision', $this->decisionToConst($indications->max(function ($indication) {
                    if  (!isset($indication['score'])) return null;
                    return $indication['score']['decision_code'];
                })));
            }
        }

        foreach ($this->display_groups as $display_group) {
            $ok = 1;

            $lastValue = false;
            $tag = "answers for display group  groups  {$display_group}";
            //   $answers= Answer::where('display_groups',$display_group)->get();
            $answers =  Cache::remember($tag, 10, function () use($display_group) {
                return Answer::where('display_groups',$display_group)->get();
            });

            foreach($answers as $answer)
                if (count($answer->tag)){

                    $key = $answer->tag[0];
                    //dd($keys->toArray());
                    if (isset($keys[$key])) {
                        $value = is_numeric($keys[$key]) > 0 ? 1 : $keys[$key];
                        if ($value != $lastValue && $lastValue) $ok = 0;
                        $lastValue = $value;
                        if ($ok)

                            $keys->put("#{$display_group}",$value);
                    }
                }
            // search answers with this display group
            // loop through answers
            // if all are no, global is no
            // if all are uknown, global is unknown
            // if all are vas, global is 1
            // else global is _void

        }
        //Todo IF is Combination!
        if ($this->names)  $keys = $this->names->merge($keys);
        else {
            $proceduresIDs = $this->procedure->getIDs($this->names);


            foreach ($proceduresIDs as $procedureID ) { //Todo New WideCombination Keys May 2019

                $this->procedure = Procedure::find($procedureID);

                //$this->procedure =  Cache::remember("", 10, function () use($procedureID){
                //    return Procedure::find($procedureID);
                //});





                $this->keys = $this->procedure->keys();
                $this->display_groups = $this->procedure->displayGroups();

                foreach ($this->display_groups as $display_group) {
                    $keys->put("#{$display_group}", '_void');

                }
            }



        }
        return $keys;
    }/** @noinspection PhpMethodNamingConventionInspection */

    /**
     * @return Collection
     */
    public function generateInitialKeys()
    {
        $keys = collect();
        $comb_proc_keys=(new Combination)->procSiblingsKeys($this->procedure->title);
        $proceduresIDs = $this->procedure->getIDs($comb_proc_keys);
        $indicationSiblingsKeys = $this->procedure->indicationSiblingsKeys($comb_proc_keys);
        $indicationSiblingsKeys = $this->toObject($indicationSiblingsKeys,"_void");



        foreach (($this->procedure->indications()->merge($indicationSiblingsKeys)) as $indication => $value) {
            $keys->put('#score ' . $indication, $value);
            $keys->put('#score', $value);
            $keys->put('#decision ' . $indication, '_void');
            $keys->put('#decsision', '_void');
        }

        foreach ($comb_proc_keys as $keyKey => $keyVal)
        {
            $comb_proc_keys[$keyVal] = 1;
            unset( $comb_proc_keys[$keyKey]);
        }

        $prodceduresKeys= collect();

        foreach ($proceduresIDs as $procedureID ) { //Todo New WideCombination Keys May 2019
            $this->procedure = Procedure::find($procedureID) ;
            $this->keys = $this->procedure->keys();
            $this->display_groups = $this->procedure->displayGroups();

            foreach ($this->display_groups as $display_group) {
                $keys->put("#{$display_group}", '_void');

            }

            $prodceduresKeys->push($this->keys);
        }
        $prodceduresKeys = $prodceduresKeys->collapse();
        $keys = $keys->merge($prodceduresKeys);
        $keys = $keys->merge($comb_proc_keys);
////info(print_r($keys,1));
        return $keys;
    }

    /**
     * @param int $code
     *
     * @return string
     */
    protected function decisionToConst($code = 0)
    {
        switch ($code) {
            case 8:
                return '_equiv_indication';
                break;
            case 3:
                return '_med_indication';
                break;
            case 1:
                return '_no_indication';
                break;
            case 2:
                return '_low_indication';
                break;
            case 4:
                return '_high_indication';
            default:
                return '_no_indication';
        }
    }

    /**
     * @param $array
     * @param $value
     * @return mixed
     */
    public function  toObject($array, $value) {

        foreach ($array as $keyKey => $keyVal)
        {
            $array[$keyVal] = $value;
            unset( $array[$keyKey]);
        }
        // $array=$array->merge($comb_proc_keys);
        //  //info(print_r($keys,1));
        return $array;

    }
}
