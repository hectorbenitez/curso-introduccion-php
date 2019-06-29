<?php

namespace App\Services;


use App\Models\Job;

class JobService
{
    public function deleteJob($id) {
        $jobId = $id+10;
        $job = Job::findOrFail($jobId);

        $job->delete();
    }
}