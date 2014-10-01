<?php 
use Illuminate\Database\Eloquent\ScopeInterface;
use Illuminate\Database\Eloquent\Builder;

class DefaultScope implements ScopeInterface{

	protected $extensions = ['WithNotPublished'];

	public function apply(Builder $builder)
	{
		$model = $builder->getModel();

		$builder->where('status' , 2);

		$this->extend($builder);
	}

	public function remove(Builder $builder)
	{
		$column = 'status';

		$query = $builder->getQuery();

		foreach ((array) $query->wheres as $key => $where)
		{

			
			// If the where clause is a soft delete date constraint, we will remove it from
			// the query and reset the keys on the wheres. This allows this developer to
			// include deleted model in a relationship result set that is lazy loaded.
			if ($this->isDefaultScopeConstraint($where, $column))
			{
		
				unset($query->wheres[$key]);

				$query->wheres = array_values($query->wheres);

				$builder->setBindings(array());
			}
		}	
	}

	public function extend(Builder $builder)
	{
		foreach ($this->extensions as $extension)
		{
			$this->{"add{$extension}"}($builder);
		}

		$builder->onDelete(function(Builder $builder)
		{
			$column = 'status';

			return $builder->update(array(
				$column => $builder->getModel()->freshTimestampString()
			));
		});
	}

	protected function addWithNotPublished(Builder $builder)
	{
		$builder->macro('withNotPublished', function(Builder $builder)
		{
			$this->remove($builder);

			//Util::trace();
			$builder->getQuery()->whereNotNull('status');

			return $builder;
		});
	}

	protected function isDefaultScopeConstraint(array $where, $column)
	{
		//Util::trace($where);
		return $where['type'] == 'Basic' && $where['column'] == $column;
	}
}