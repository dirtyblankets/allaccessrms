<?php namespace AllAccessRMS\Core\Scopes;

use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ScopeInterface;

class TenantScope implements ScopeInterface
{
    protected $tenant_col = 'organization_id';

    protected $tenant_id;

    public function apply(Builder $builder, Model $model)
    {
        $this->tenant_id = Session::get('tenant_id');
        $builder->whereRaw($model->getTenantWhereClause($this->tenant_col, $this->tenant_id));
    }

    public function remove(Builder $builder, Model $model)
    {
        $query = $builder->getQuery();
        foreach( (array) $query->wheres as $key => $where) {
            if($this->isTenantConstraint($model, $where, $this->tenant_col, 1)) {
                unset($query->wheres[$key]);

                $query->wheres = array_values($query->wheres);
                break;
            }
        }
    }

    public function isTenantConstraint($model, array $where, $tenantColumn, $tenantId)
    {
        return $where['type'] == 'raw' && $where['sql'] == $model->getTenantWhereClause($tenantColumn, $tenantId);
    }
}