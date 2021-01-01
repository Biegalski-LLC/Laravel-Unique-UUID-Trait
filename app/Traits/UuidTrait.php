<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/**
 * Trait UuidTrait
 * @package App\Traits
 */
trait UuidTrait
{
    /**
     * @return string
     */
    public function generateUuid(): string
    {
        return (string) Str::uuid();
    }

    /**
     * @param string $model
     * @param string $column
     * @return string
     * @throws Exception
     */
    public function generateModelUuid(string $model, string $column = 'uuid'): string
    {
        try{
            
            do {
                $uuid = $this->generateUuid();
            } while (
                DB::table($model)->where($column, '=', $uuid)->first() instanceof DB
            );

            return $uuid;
            
        }catch (Exception $exception){
            return $exception->getMessage();
        }
    }
}
