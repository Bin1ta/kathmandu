<?php

namespace App\Observers;

use App\Models\Employee;

class EmployeeObserver
{
    public function creating(Employee $employee): void
    {
        if (is_null($employee->position)) {
            $employee->position = Employee::where(function($q) use($employee){
                if(!empty($employee->ward)){
                    $q->where("ward", $employee->ward);
                }
            })->max('position') + 1;

            return;
        }

        $lowerPriorityEmployees = Employee::where(function($q) use($employee){
            if(!empty($employee->ward)){
                $q->where("ward", $employee->ward);
            }
        })
        ->where('position', '>=', $employee->position)
            ->get();

        foreach ($lowerPriorityEmployees as $lowerPriorityEmployee) {
            $lowerPriorityEmployee->position++;
            $lowerPriorityEmployee->saveQuietly();
        }
    }

    public function updating(Employee $employee): void
    {
        if ($employee->isClean('position')) {
            return;
        }

        if (is_null($employee->position)) {
            $employee->position = Employee::where(function($q) use($employee){
                if(!empty($employee->ward)){
                    $q->where("ward", $employee->ward);
                }
            })
            ->max('position');
        }

        if ($employee->getOriginal('position') > $employee->position) {
            $positionRange = [
                $employee->position, $employee->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $employee->getOriginal('position'), $employee->position,
            ];
        }

        $lowerPriorityEmployees = Employee::where(function($q) use($employee){
            if(!empty($employee->ward)){
                $q->where("ward", $employee->ward);
            }
        })
        ->whereBetween('position', $positionRange)
            ->where('id', '!=', $employee->id)
            ->get();

        foreach ($lowerPriorityEmployees as $lowerPriorityEmployee) {
            if ($employee->getOriginal('position') < $employee->position) {
                $lowerPriorityEmployee->position--;
            } else {
                $lowerPriorityEmployee->position++;
            }
            $lowerPriorityEmployee->saveQuietly();
        }
    }

    public function deleting(Employee $employee): void
    {
        $lowerPriorityEmployees = Employee::where(function($q) use($employee){
            if(!empty($employee->ward)){
                $q->where("ward", $employee->ward);
            }
        })
        ->where('position', '>', $employee->position)
            ->get();

        foreach ($lowerPriorityEmployees as $lowerPriorityEmployee) {
            $lowerPriorityEmployee->position--;
            $lowerPriorityEmployee->saveQuietly();
        }
    }
}
