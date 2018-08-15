<?php
namespace App\Controllers;

use App\Models\Job;

class JobsController {
    public function getAddJobAction() {
        if (!empty($_POST)) {
            $job = new Job();
            $job->title = $_POST['title'];
            $job->description = $_POST['description'];
            $job->save();
        }

        include '../views/addJob.php';
    }
}