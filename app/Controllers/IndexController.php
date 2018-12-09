<?php

namespace App\Controllers;

use App\Models\{Job, Project};

class IndexController extends BaseController {
    public function indexAction() {
        $jobs = Job::all();
        $project1 = new Project('Project 1', 'Description 1');
        $projects = [
            $project1
        ];

        $name = 'Hector Benitez';
        $limitMonths = 0;

        $filterClosure = function (array $job) use ($limitMonths) {
            return $job['months'] >= $limitMonths;
        };

//        $jobs = array_filter($jobs->toArray(), $filterClosure);

        return $this->renderHTML('index.twig', [
            'name' => $name,
            'jobs' => $jobs
        ]);
    }
}