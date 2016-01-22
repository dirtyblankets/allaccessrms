<?php namespace AllAccessRMS\Core\Scopes\Traits;

use App;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Model;
use AllAccessRMS\Core\Scopes\TenantScope;

trait TenantScopedModelTrait
{
    public static function bootTenantScopedModelTrait()
    {
        $tenantScope = App::make('AllAccessRMS\Core\Scopes\TenantScope');

        // Add Global scope that will handle all operations except create()
        static::addGlobalScope($tenantScope);
    }

    public static function allTenants()
    {
        return with(new static())->newQueryWithoutScope(new TenantScope());
    }

    public function getTenantWhereClause($tenantColumn, $tenantId)
    {
        return "{$this->getTable()}.{$tenantColumn} = '{$tenantId}''";
    }
}