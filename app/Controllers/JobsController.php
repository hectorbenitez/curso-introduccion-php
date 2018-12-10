<?php
namespace App\Controllers;

use App\Models\Job;
use App\Services\JobService;
use Respect\Validation\Validator as v;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

class JobsController extends BaseController {
    private $jobService;

    public function __construct(JobService $jobService)
    {
        parent::__construct();
        $this->jobService = $jobService;
    }

    public function indexAction() {
        $jobs = Job::all();
        return $this->renderHTML('jobs/index.twig', compact('jobs'));
    }

    public function getAddJobAction($request) {
        $responseMessage = null;

        if ($request->getMethod() == 'POST') {
            $postData = $request->getParsedBody();
            $jobValidator = v::key('title', v::stringType()->notEmpty())
                  ->key('description', v::stringType()->notEmpty());

            try {
                $jobValidator->assert($postData);
                $postData = $request->getParsedBody();

                $files = $request->getUploadedFiles();
                $logo = $files['logo'];

                if($logo->getError() == UPLOAD_ERR_OK) {
                    $fileName = $logo->getClientFilename();
                    $fullPath = "uploads/$fileName";

                    $logo->moveTo($fullPath);
                }

                $job = new Job();
                $job->title = $postData['title'];
                $job->description = $postData['description'];
                $job->image = $fullPath;
                $job->save();

                $responseMessage = 'Saved';
            } catch (\Exception $e) {
                $responseMessage = $e->getMessage();
            }
        }

        return $this->renderHTML('addJob.twig', [
            'responseMessage' =>$responseMessage
        ]);
    }

    public function deleteAction(ServerRequest $request) {
        $this->jobService->deleteJob($request->getAttribute('id'));
        return new RedirectResponse('/jobs');
    }
}