<?php

namespace App\Models\Traits;


trait SyncOneToMany
{
	public function sync($relationship, $data, $deleting = true, $adminUpdate = true)
	{
		$changes = [
			'created' => [], 'deleted' => [], 'updated' => [],
		];
		$relatedKeyName = $this->$relationship()->getRelated()->primaryKey;
		$foreignKey = $this->$relationship()->getForeignKeyName();
		$localKey = $this->$relationship()->getLocalKeyName();
		$adminUpdate = $adminUpdate && method_exists($this->$relationship()->getModel(), 'adminUpdate');

		// First we need to attach any of the associated models that are not currently
		// in the child entity table. We'll spin through the given IDs, checking to see
		// if they exist in the array of current ones, and if not we will insert.
		$current = $this->$relationship->pluck(
			$relatedKeyName
		)->all();
		
		// Separate the submitted data into "update" and "new"
		$updateRows = [];
		$newRows = [];
		foreach ($data as $row) {
			// We determine "updateable" rows as those whose $relatedKeyName (usually 'id') is set, not empty, and
			// match a related row in the database.
			if (isset($row[$relatedKeyName]) && !empty($row[$relatedKeyName]) && in_array($row[$relatedKeyName], $current)) {
				$id = $row[$relatedKeyName];
				$updateRows[$id] = $row;
			} else {
				$newRows[] = $row;
			}
		}
		
		// Update the updatable rows
		foreach ($updateRows as $row) {
			$model = $this->$relationship()->where($relatedKeyName, $row[$relatedKeyName])->first();
			if ($model)
				$model->fill($row);
			if ($model->isDirty()) {
				if ($adminUpdate) {
					$model->adminUpdate();
				} else {
					$model->save();
				}
				$changes['updated'][] = $model->id;
			}
		}
		
		// Next, we'll determine the rows in the database that aren't in the "update" list.
		// These rows will be scheduled for deletion.  Again, we determine based on the relatedKeyName (typically 'id').
		$updateIds = array_keys($updateRows);
		$deleteIds = [];
		foreach ($current as $currentId) {
			if (!in_array($currentId, $updateIds)) {
				$deleteIds[] = $currentId;
			}
		}
		
//		$changes['updated'] = $this->castKeys($updateIds);
		
		// Insert the new rows
		$newIds = [];
		foreach ($newRows as $row) {
			$model = $this->$relationship()->getModel()->newInstance(array_merge($row, [$foreignKey => $this->$localKey]));
			if ($adminUpdate) {
				$model->adminCreate();
			} else {
				$model->save();
			}
		};
		
		$changes['created'][] = $this->castKeys($newIds);
		
		// Delete any non-matching rows
		if ($deleting && count($deleteIds) > 0) {
			$deletes = $this->$relationship->whereIn($relatedKeyName, $deleteIds)->all();
			foreach ($deletes as $model) {
				if ($adminUpdate) {
					$model->adminDelete();
				} else {
					$model->delete();
				}
			}
			
			$changes['deleted'] = $this->castKeys($deleteIds);
		}
		return $changes;
	}
	
}
