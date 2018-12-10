<?php

namespace App\Services;


use App\Models\Job;

class JobService
{
    public function deleteJob($id) {
        $jobId = $id;
        $job = Job::find($jobId);
        $job->delete();
    }
}