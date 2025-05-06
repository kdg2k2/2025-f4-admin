<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

trait TryCatchTraits
{
    public function transaction(callable $callback)
    {
        try {
            DB::beginTransaction();
            $result = $callback();
            DB::commit();
            return $result;
        } catch (ValidationException $e) {
            dd($e);
            throw $e;
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            throw $e;
        }
    }

    public function tryThrow(callable $callback)
    {
        try {
            $result = $callback();
            return $result;
        } catch (ValidationException $e) {
            dd($e);
            throw $e;
        } catch (Exception $e) {
            dd($e);
            throw $e;
        }
    }

    public function catchWeb(callable $callback)
    {
        try {
            return $callback();
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return back()->with('err', implode(', ', $errors));
        } catch (Exception $e) {
            return back()->with('err', $e->getMessage());
        }
    }

    public function catchAPI(callable $callback)
    {
        $mess = null;
        $code = null;

        try {
            return $callback();
        } catch (ValidationException $e) {
            $mess = $e->errors();
            $code = $e->status;
        } catch (Exception $e) {
            $mess = $e->getMessage();
            $code = $this->getErrorCode($e);
        }

        return response()->json([
            "message" => $mess
        ], $code);
    }

    protected function getErrorCode($e)
    {
        $statusCode = $e->getCode() ?: 500;
        $statusCode = is_int($statusCode) && $statusCode >= 100 && $statusCode < 600
            ? $statusCode
            : 500;
        return $statusCode;
    }
}
