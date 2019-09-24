<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;


class ApiController extends Controller
{
    const NOT_FOUND = 404;

    const NOT_ACCEPTABLE = 406;

    public function responseNotFound($message = 'No found...')
    {
        return response()->json(['code' => self::NOT_FOUND, 'message' => $message], self::NOT_FOUND);
    }

    public function responseNotAcceptable($message = 'No acceptable...', $expression = '', $original_expression = '', $source = null)
    {

        return response()->json(
            [
                'code' => self::NOT_ACCEPTABLE,
                'message' => $message,
                'expression' => $expression,
                'original_expression' => $original_expression,
                'source' => $source,
                'source_type' => get_class($source)
            ],
            self::NOT_ACCEPTABLE
        );
    }
}